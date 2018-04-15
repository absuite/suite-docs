<template>
  <div class="container-wrapper md-layout-row">
    <div class="main-nav-container">
      <transition name="nav" appear>
        <md-content class="main-nav layout lauout-column">
          <md-toolbar md-elevation="1">
            <router-link :to="{name:'docs.product',params:{product:mainProduct.id}}">{{mainProduct.title}}</router-link>
          </md-toolbar>
          <div class="flex nav-list md-scrollbar">
            <template v-for="item in navs">
              <router-link :to="{name:'docs.product',params:{product:mainProduct.id,id:item.id}}">{{item.title}}</router-link>
              <div class="main-nav-level" v-if="item.childs&& item.childs.length">
                <template v-for="s in item.childs">
                  <router-link :to="{name:'docs.product',params:{product:mainProduct.id,id:s.id}}">{{ s.title}}</router-link>
                  <div class="main-nav-level" v-if="s.childs&& s.childs.length">
                    <template v-for="ss in s.childs">
                      <router-link :to="{name:'docs.product',params:{product:mainProduct.id,id:ss.id}}">{{ ss.title}}</router-link>
                    </template>
                  </div>
                </template>
              </div>
            </template>
          </div>
          <md-toolbar md-elevation="1">
            <div class="md-toolbar-row">
              <div class="md-toolbar-section-start">
                <md-button class="md-icon-button" @click="onItemAdd">
                  <md-icon>add</md-icon>
                </md-button>
              </div>
              <span class="flex"></span>
              <div class="md-toolbar-section-end">
                <md-button class="md-icon-button" @click="onItemEdit" :disabled="!mainPost.id">
                  <md-icon>edit</md-icon>
                </md-button>
                <md-button class="md-icon-button" @click="onItemRemove" :disabled="!mainPost.id">
                  <md-icon>clear</md-icon>
                </md-button>
              </div>
            </div>
          </md-toolbar>
        </md-content>
      </transition>
    </div>
    <div class="main-container">
      <md-card class="md-elevation-0 ql-snow" v-if="mainPost&&mainPost.id">
        <md-card-header>
          <div class="md-title">{{ mainPost.title }}</div>
        </md-card-header>
        <md-divider></md-divider>
        <md-card-content class="ql-editor">
          <div v-html="mainPost.content"></div>
        </md-card-content>
      </md-card>
    </div>
    <post-edit ref="postEdit" @md-closed="fetchNavDatas"></post-edit>
  </div>
</template>
<script>
import PostEdit from '../components/PostEdit'
export default {
  components: {
    PostEdit,
  },
  data: () => ({
    loading: false,
    navs: [],
    mainProduct: {},
    mainPost: {}
  }),
  watch: {
    '$route.params.id' (to, from) {
      this.fetchPostData();
    },
    '$route.params.product' (to, from) {
      this.fetchProductData();
      this.fetchNavDatas();
    }
  },
  methods: {
    onItemAdd() {
      this.$refs.postEdit.open({
        product_id: this.$route.params.product,
        parent_id: this.$route.params.id
      });
    },
    onItemEdit() {
      this.$refs.postEdit.open({
        product_id: this.$route.params.product,
        id: this.$route.params.id
      });
    },
    async onItemRemove() {
      if (this.$route.params.id) {
        try {
          await this.$http.delete('docs/posts/' + this.$route.params.id);
          await this.fetchNavDatas();
          this.$go({ name: 'docs.product', params: { product: mainProduct.id } });
        } catch (err) {
          this.$toast(err);
        }
      }
    },
    async fetchNavDatas() {
      try {
        const response = await this.$http.get('docs/posts/catalogs', { params: { product: this.$route.params.product } });
        this.navs = response.data.data;
      } catch (err) {
        this.$toast(err);
      }

    },
    async fetchPostData() {
      if (!this.$route.params.id) return;
      try {
        const response = await this.$http.get('docs/posts/' + this.$route.params.id);

        this.mainPost = response.data.data;
      } catch (err) {
        this.$toast(err);
      }
    },
    async fetchProductData() {
      if (!this.$route.params.product) return;
      try {
        const response = await this.$http.get('docs/products/' + this.$route.params.product);

        this.mainProduct = response.data.data;
      } catch (err) {
        this.$toast(err);
      }
    },
  },
  created() {},
  mounted() {
    window.setTimeout(() => {
      this.message = true
    }, 2000);
    this.fetchProductData();
    this.fetchNavDatas();
    this.fetchPostData();
  }
}
</script>
<style lang="scss" scoped>
@import "~gmf/components/MdAnimation/variables";
@import "~gmf/components/MdLayout/mixins";
.container-wrapper {
  flex: 1;
  padding-left: 270px;
  @include md-layout-xsmall {
    padding-left: 0 !important;
  }
}

.main-nav {
  width: 270px;
  padding: 0px;
  display: flex;
  align-items: flex-start;
  flex-direction: column;
  overflow: auto;
  position: fixed;
  top: 64px;
  bottom: 0;
  left: 0;
  z-index: 2;
  transition: .3s $md-transition-default-timing;
  transition-property: top;
  @include md-layout-small {
    top: 56px;
  }
  @include md-layout-xsmall {
    top: 56px;
  }

  .nav-list {
    padding: 20px;
    overflow: auto;
    width: 100%;

    a {
      display: block;
      color: inherit;
      font-size: 16px;
      line-height: 2em;
      &.router-link-active {
        color: var(--md-theme-default-primary, #0f9d58);
        font-weight: 500;
      }
    }

    .main-nav-level {
      margin-left: 20px;
    }
  }
}

.nav-leave-active {
  display: none;
}

.nav-enter-active {
  opacity: 0;
  transform: translate3d(-100%, 0, 0);
  transition: .4s $md-transition-default-timing;
  transition-property: opacity, transform;
  will-change: opacity, transform;
}

.nav-enter-to {
  opacity: 1;
  transform: translate3d(0, 0, 0);
}

.main-container {
  flex: 1;
  padding: 10px;
  >.md-card {
    margin: 0 auto;
    max-width: 890px;
  }
  blockquote {}
}
</style>