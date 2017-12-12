<template>
  <div class="container">
    <main-header />
    <div class="container-wrapper md-layout-row">
      <div class="main-nav-container">
        <transition name="nav" appear>
          <md-content class="main-nav layout lauout-column">
            <div class="flex nav-list md-scrollbar">
              <template v-for="item in navs">
                <router-link :to="{name:'docs.product.show',params:{id:item.id}}">{{navs.title}}</router-link>
                <div class="main-nav-level" v-if="item.nodes&& item.nodes.length">
                  <template v-for="s in item.nodes">
                    <router-link :to="{name:'docs.product.show',params:{id:s.id}}">{{ s.title}}</router-link>
                    <div class="main-nav-level" v-if="s.nodes&& s.nodes.length">
                      <template v-for="ss in s.nodes">
                        <router-link :to="{name:'docs.product.show',params:{id:ss.id}}">{{ ss.title}}</router-link>
                      </template>
                    </div>
                  </template>
                </div>
              </template>
            </div>
            <md-toolbar>
              <div class="md-toolbar-row">
                <div class="md-toolbar-section-start">
                  <md-button class="md-icon-button">
                    <md-icon>add</md-icon>
                  </md-button>
                  <md-button class="md-icon-button">
                    <md-icon>send</md-icon>
                  </md-button>
                </div>
                <span class="flex"></span>
                <div class="md-toolbar-section-end">
                  <md-button class="md-icon-button">
                    <md-icon>edit</md-icon>
                  </md-button>
                  <md-button class="md-icon-button">
                    <md-icon>clear</md-icon>
                  </md-button>
                </div>
              </div>
            </md-toolbar>
          </md-content>
        </transition>
      </div>
      <div class="main-container" v-if="loading">
      </div>
      <router-view v-else />
    </div>
  </div>
</template>
<script>
import MainHeader from './template/MainHeader'
export default {
  name: 'DocsProduct',
  components: {
    MainHeader,
  },
  data: () => ({
    loading: false,
    message: false,
    navs: []
  }),
  computed: {

  },
  methods: {
    closeMessage() {
      this.message = false
    },
    beforeRouteRender(to, from, next) {
      this.loading = true
      next()
    },
    afterRouteRender() {
      this.loading = false
    },
    fetchNavDatas() {
      this.$http.get('docs/catalogs',{params:{product:this.$route.params.product}}).then(response => {
        this.navs = response.data.data;
      }).catch(err => {
        this.$toast(err);
      });
    },
  },
  created() {
    this.$router.beforeEach(this.beforeRouteRender)
    this.$router.afterEach(this.afterRouteRender)
  },
  mounted() {
    window.setTimeout(() => {
      this.message = true
    }, 2000);
    this.fetchNavDatas();
  }
}
</script>
<style lang="scss" scoped>
@import "~vue-material/components/MdAnimation/variables";
@import "~vue-material/components/MdLayout/mixins";
@import "~vue-material/theme/engine";
.container {
  min-height: 100%;
  padding-top: 64px;
  display: flex;
  flex-direction: column;
  transition: $md-transition-default;
  transition-property: padding-top;
  @include md-layout-small {
    padding-top: 48px;
  }
  @include md-layout-xsmall {
    padding-top: 56px;
  }
}

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

    .main-nav-level {
      margin-bottom: 16px;
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
}
</style>