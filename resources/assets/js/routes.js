const routeList = [{
    path: '/docs',
    name: 'docs.home',
    componentName: 'DocsHome'
  },
  {
    path: '/docs/:product',
    name: 'docs.product',
    componentName: 'DocsProduct',
    children: [{
      path: ':id',
      name: 'docs.product.show',
      componentName: 'DocsProductShow'
    }]
  },
];

function getComponent(name) {
  return {
    template: '<md-wrap name="' + name + '"></md-wrap>'
  };
}
const routes = routeList.map((route) => {
  if (route.componentName) {
    route.component = getComponent(route.componentName);
  }

  if (route.children && route.children.length > 0) {
    route.children.map((r) => {
      if (r.componentName) {
        r.component = getComponent(r.componentName);
      }
      return r;
    });
  }
  return route;
});

export default routes;