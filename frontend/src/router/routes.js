
const routes = [
  {
    path: '/',
    component: () => import('layouts/MainLayout.vue'),
    children: [
      { path: '/', name: 'inicio', component: () => import('pages/Cardapio.vue') },
      { path: '/produto/:id', name: 'produto', component: () => import('pages/Produto.vue') },
      { path: '/pedidos', name: 'pedidos', component: () => import('pages/Pedidos.vue') },
      { path: '/perfil', name: 'perfil', component: () => import('pages/Perfil.vue') },
      { path: '/carrinho', name: 'carrinho', component: () => import('pages/Carrinho.vue') }
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
