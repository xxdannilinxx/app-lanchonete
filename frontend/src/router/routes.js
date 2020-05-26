
const routes = [
  {
    path: '/',
    component: () => import('layouts/Main.vue'),
    children: [
      { path: '/', component: () => import('pages/produtos/index.vue') },
      { path: '/produto/:id', name: 'produto', component: () => import('pages/produtos/produto.vue') },
      { path: '/pedidos', name: 'pedidos', component: () => import('pages/pedidos/index.vue') },
      { path: '/carrinho', name: 'carrinho', component: () => import('pages/carrinho/index.vue') },
      { path: '/perfil', name: 'perfil', component: () => import('pages/perfil/index.vue') },
      { path: '/perfil/editar', name: 'editar', component: () => import('pages/perfil/editar.vue') },
      { path: '/perfil/endereco', name: 'endereco', component: () => import('pages/perfil/endereco.vue') },
      { path: '/perfil/informacoes', name: 'informacoes', component: () => import('pages/perfil/informacoes.vue') },
      { path: '/perfil/configuracoes', name: 'configuracoes', component: () => import('pages/perfil/configuracoes.vue') }
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
