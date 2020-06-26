
const routes = [
  {
    path: '/',
    component: () => import('layouts/Main.vue'),
    children: [
      { path: '/', meta: { title: 'Início' }, component: () => import('pages/produtos/index.vue') },
      { path: '/produto/:id', name: 'produto', meta: { title: 'Produto' }, component: () => import('pages/produtos/produto.vue') },
      { path: '/pedidos', name: 'pedidos', meta: { title: 'Pedidos' }, component: () => import('pages/pedidos/index.vue') },
      { path: '/carrinho', name: 'carrinho', meta: { title: 'Carrinho' }, component: () => import('pages/carrinho/index.vue') },
      { path: '/perfil', name: 'perfil', meta: { title: 'Perfil' }, component: () => import('pages/perfil/index.vue') },
      { path: '/perfil/editar', name: 'editar', meta: { title: 'Editar' }, component: () => import('pages/perfil/editar.vue') },
      { path: '/perfil/enderecos', name: 'enderecos', meta: { title: 'Endereços' }, component: () => import('pages/perfil/enderecos/index.vue') },
      { path: '/perfil/enderecos/editar/:id', name: 'editarendereco', meta: { title: 'Endereço' }, component: () => import('pages/perfil/enderecos/editar.vue') },
      { path: '/perfil/informacoes', name: 'informacoes', meta: { title: 'Informações' }, component: () => import('pages/perfil/informacoes/index.vue') },
      { path: '/perfil/configuracoes', name: 'configuracoes', meta: { title: 'Configurações' }, component: () => import('pages/perfil/configuracoes/index.vue') }
    ]
  },
  { path: '/entrar', name: 'entrar', component: () => import('pages/entrar/index.vue') }
]

if (process.env.MODE !== 'ssr') {
  routes.push({
    path: '*',
    component: () => import('pages/Error404.vue')
  })
}

export default routes
