export const state = {
    itens: JSON.parse(localStorage.getItem('carrinho')) || []
}
