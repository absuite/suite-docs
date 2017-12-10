<template>
  <div class="container">
    <main-header />
    <div class="container-wrapper md-layout-row">
      <div class="main-nav-container">
        <transition name="nav" appear>
          <md-content class="main-nav md-scrollbar">
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
    message: false
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
    }
  },
  created() {
    this.$router.beforeEach(this.beforeRouteRender)
    this.$router.afterEach(this.afterRouteRender)
  },
  mounted() {
    window.setTimeout(() => {
      this.message = true
    }, 2000)
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
  padding: 20px 16px 112px;
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