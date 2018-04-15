<template>
  <div class="container">
    <main-header />
    <router-view></router-view>
  </div>
</template>
<script>
import MainHeader from './template/MainHeader'
export default {
  components: {
    MainHeader,
  },
  data: () => ({
    loading: false
  }),
  computed: {

  },
  methods: {
  },
  mounted() {
  }
}
</script>
<style lang="scss" scoped>
@import "~gmf/components/MdAnimation/variables";
@import "~gmf/components/MdLayout/mixins";

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
</style>