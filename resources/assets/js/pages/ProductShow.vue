<template>
  <div class="container">
    {{ mainData }}
  </div>
</template>
<script>
export default {
  name: 'DocsProductShow',
  components: {
  },
  data: () => ({
    mainData:{}
  }),
  computed: {

  },
  methods: {
    fetchDatas() {
      this.$http.get('docs/posts/'+this.$route.params.id).then(response => {
        this.mainData = response.data.data;
      }).catch(err => {
        this.$toast(err);
      });
    },
  },
  created() {
  },
  mounted() {
    this.fetchDatas();
  }
}
</script>
<style lang="scss" scoped>
@import "~vue-material/components/MdAnimation/variables";
@import "~vue-material/components/MdLayout/mixins";
@import "~vue-material/theme/engine";

</style>