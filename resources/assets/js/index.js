import components from './components';

import config from 'gmf/config';
import routes from './routes';


import DocsHome from './DocsHome';
import DocsProduct from './DocsProduct';
const options = {
  components,
};

options.install = (Vue) => {
  if (options.installed) {
    console.warn('Vue Material is already installed.');
    return;
  }
  config.route(routes);

  Vue.component(DocsHome.name, DocsHome);
  Vue.component(DocsProduct.name, DocsProduct);

  for (let component in options) {
    const componentInstaller = options[component];

    if (componentInstaller && component !== 'install') {
      Vue.use(componentInstaller);
    }
  }
  options.installed = true;
};

export default options;