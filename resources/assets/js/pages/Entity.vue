<template>
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
</template>
<script>
export default {

  data: () => ({
    mainDatas: []
  }),
  computed: {

  },
  methods: {
    goProduct(item) {
      if (item && item.id)
        this.$go({ name: 'docs.product', params: { product: item.id } });
    },
    fetchMainDatas() {
      this.$http.get('docs/products').then(response => {
        this.mainDatas = response.data.data;
      }).catch(err => {
        this.$toast(err);
      });
    }
  },
  mounted() {
    this.fetchMainDatas();
  }
}
</script>
<style lang="scss" scoped>
@import "~vue-material/components/MdAnimation/variables";
@import "~vue-material/components/MdLayout/mixins";

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