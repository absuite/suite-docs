import config from 'gmf/config';
import routes from './routes';

const options = {};

options.install = (Vue) => {
  if (options.installed) {
    console.warn('Vue Material is already installed.');
    return;
  }
  config.route(routes);


  for (let component in options) {
    const componentInstaller = options[component];

    if (componentInstaller && component !== 'install') {
      Vue.use(componentInstaller);
    }
  }
  options.installed = true;
};

export default options;