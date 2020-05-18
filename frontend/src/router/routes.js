
const routes = [
  {
    path: '/',
    component: () => import('layouts/Main.vue'),
    children: [
      { path: '/', name: 'produtos', component: () => import('pages/produtos/index.vue') },
      { path: '/produto/:id', name: 'produto', component: () => import('pages/produtos/produto.vue') },
      { path: '/pedidos', name: 'pedidos', component: () => import('pages/pedidos/index.vue') },
      { path: '/carrinho', name: 'carrinho', component: () => import('pages/carrinho/index.vue') },
      { path: '/perfil', name: 'perfil', component: () => import('pages/perfil/index.vue') },
      { path: '/perfil/dados', name: 'dados', component: () => import('pages/perfil/dados.vue') },
      { path: '/perfil/endereco', name: 'endereco', component: () => import('pages/perfil/endereco.vue') },
      { path: '/perfil/informacoes', name: 'informacoes', component: () => import('pages/perfil/informacoes.vue') },
      { path: '/perfil/configuracoes', name: 'configuracoes', component: () => import('pages/perfil/configuracoes.vue') }
    ]
  }
]

if (process.env.MODE !== 'ssr') {
  routes.push({
    path: '*',
    component: () => import('pages/Error404.vue')
  })
}

export default routes
