<template>
  <md-toolbar class="suite-docs-main-header md-primary" md-elevation="1">
    <div class="md-toolbar-row">
      <div class="md-toolbar-section-start">
        <router-link class="md-logo" :to="{name:'docs.home'}">
          <cbo-logo animated></cbo-logo>
        </router-link>
        <div class="md-title">
          <h1>文档</h1>
        </div>
      </div>
      <div class="flex search">
        <md-autocomplete v-model="search_q" :md-options="search_options" md-layout="box">
          <label>智能搜索...</label>
        </md-autocomplete>
      </div>
    </div>
  </md-toolbar>
</template>
<script>
export default {
  name: 'MainHeader',
  data: () => ({
    search_q: '',
    search_options: [],
    themeMenuActive: false
  }),
  computed: {},
  methods: {

  }
}
</script>
<style lang="scss">
@import "~gmf/components/MdAnimation/variables";
@import "~gmf/components/MdElevation/mixins";
@import "~gmf/components/MdLayout/mixins";

.suite-docs-main-header {
  margin: auto;
  max-width: 100%;
  position: fixed;
  top: 0;
  right: 0;
  left: 0;
  z-index: 3;
  transition: .3s $md-transition-default-timing,
  box-shadow .4s .1s $md-transition-stand-timing;
  will-change: box-shadow, max-width, background-color;

  &.md-transparent {
    background-color: #303030;
  }
  .md-logo {
    display: inline-flex;
    justify-content: center;
    align-items: center;
    height: 56px;
    padding: 0px;
    cursor: pointer;
  }
  .search {
    margin-right: 12px;
    margin-left: 20px;
  }
  .md-title {
    flex: 1;
    h1 {
      display: inline-block;
      font-size: 20px;
    }
  }
}
</style>