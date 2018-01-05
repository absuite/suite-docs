const routes = [{
  path: '/docs',
  name: 'docs',
  component: () =>
    import ('./App.vue'),
  children: [{
    path: 'home',
    name: 'docs.home',
    component: () =>
      import ('./pages/Home.vue'),
  }, {
    path: 'entity/:id?',
    name: 'docs.entity',
    component: () =>
      import ('./pages/Entity.vue'),
  }, {
    path: 'product/:product/:id?',
    name: 'docs.product',
    component: () =>
      import ('./pages/Product.vue'),
  }]
}];

export default routes;