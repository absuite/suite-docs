<template>
  <div class="container">
    <main-header />
    <div class="container-wrapper md-layout-row">
      <div class="main-container layout layout-row layout-wrap">
        <md-card class="item" md-with-hover v-for="item in mainDatas" :key="item.id" @click.native="goProduct(item)">
          <md-ripple>
            <md-card-media>
              <img :src="item.cover">
            </md-card-media>
            <md-card-header>
              <div class="md-title">{{ item.title }}</div>
              <div class="md-subhead">{{ item.summary }}</div>
            </md-card-header>
          </md-ripple>
        </md-card>
      </div>
    </div>
  </div>
</template>
<script>
import MainHeader from './template/MainHeader'
export default {
  name: 'DocsHome',
  components: {
    MainHeader,
  },
  data: () => ({
    loading: false,
    mainDatas: [{
      id: 1,
      cover: '/img/vendor/suite-docs/cover/1.png',
      title: '阿米巴巴套件实施手册',
      summary: '这是一本旨在帮助你成功实施阿米巴巴套件的手册'
    }, {
      id: 2,
      cover: '/img/vendor/suite-docs/cover/2.png',
      title: '阿米巴巴套件帮助文档',
      summary: '想获得更多相关信息，请参阅帮助文档!'
    }, {
      id: 3,
      cover: '/img/vendor/suite-docs/cover/3.png',
      title: '阿米巴巴套件接口开发手册',
      summary: '介绍第三方接口如何快速与套件集成，定制接口'
    }, {
      id: 4,
      cover: '/img/vendor/suite-docs/cover/4.png',
      title: '阿米巴巴套件API说明',
      summary: '详细描述套件API信息'
    }, {
      id: 5,
      cover: '/img/vendor/suite-docs/cover/5.png',
      title: '阿米巴巴套件速查表',
      summary: '阿米巴巴套件实体信息查询'
    }, {
      id: 6,
      cover: '/img/vendor/suite-docs/cover/6.png',
      title: '阿米巴巴套件开发手册',
      summary: '阿米巴巴套件实体信息查询'
    }]
  }),
  computed: {

  },
  methods: {
    goProduct(item) {
      if (item && item.id)
        this.$go({ name: 'docs.product', params: { product: item.id } });
    }
  },
  created() {},
  mounted() {

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

.main-container {
  margin: 0 auto;
  max-width: 1200px;
  width: 100%;
  >.item {
    margin: 10px;
    width: 380px
  }
}
</style>