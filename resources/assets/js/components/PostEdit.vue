<template>
  <md-dialog :md-active.sync="showDialog" :md-click-outside-to-close="false" :md-close-on-esc="false" md-fullscreen @md-opened="fetchData" @md-closed="onClosed" class="suite-docs-post-edit">
    <md-dialog-title>
      <md-field class="post-title">
        <label>标题</label>
        <md-input v-model="mainData.title"></md-input>
      </md-field>
    </md-dialog-title>
    <md-dialog-content>
      <md-editor v-model="mainData.content" :height="300" placeholder="详细内容!"></md-editor>
    </md-dialog-content>
    <md-dialog-actions>
      <md-button class="md-primary" @click="showDialog = false">取消</md-button>
      <md-button class="md-primary" @click="onSave">
        <md-icon>save</md-icon>
        <span>保存</span>
      </md-button>
    </md-dialog-actions>
    <md-loading :loading="loading"></md-loading>
  </md-dialog>
</template>
<script>
export default {
  name: 'DocsPostEdit',
  props: {
    mdParent: String,
    mdId: String,
    mdProduct: String
  },
  data() {
    return {
      showDialog: false,
      mainData: { title: '', content: '' },
      loading: 0,
    };
  },
  methods: {
    open(data) {
      this.mainData={ title: '', content: '' };
      if(data){
        this.mainData = Object.assign({}, this.mainData, data);
      }
      this.showDialog = true;
    },
    async onSave() {
      if (!this.mainData.title || this.mainData.title.replace(/(^\s*)|(\s*$)/g, "").length < 1) {
        alert('标题至少需要2个字符！');
        return;
      }
      try {
        this.loading++;
        var response=null;
        if(this.mainData.id){
          response = await this.$http.put('docs/posts/'+this.mainData.id, this.mainData);
        }else{
          response = await this.$http.post('docs/posts', this.mainData);
        }
        this.mainData = response.data.data;
        this.showDialog = false;
      } catch (e) {
        this.mainData.id = '';
        this.$toast(e);
      } finally {
        this.loading--;
      }
    },
    async fetchData() {
      if (!this.mainData.id){
        return;
      }
      try {
        const response = await this.$http.get('docs/posts/' + this.mainData.id);
        this.mainData = response.data.data;
      } catch (e) {
        this.$toast(e);
      } finally {}
    },
    onClosed() {
      this.$emit('md-closed', this.mainData.id ? this.mainData : null);
    },
  },
  created() {},
  mounted() {},
};
</script>
<style lang="scss">
.suite-docs-post-edit {
  width: 100%;
}
</style>