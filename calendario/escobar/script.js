const playerInventory = {
    "itens": [
        { "id": "leite", "quantiadde": 10, "peso": 1, "nome": "Leite de Com Toddy", "tipo": "bebida", "imagem": "leite.png" },
        { "id": "big_mac", "quantiadde": 5, "peso": 1, "nome": "Big Mac", "tipo": "comida", "imagem": "bigmac.png" },
        { "id": "porta_carro", "quantiadde": 1, "peso": 10, "nome": "Porta", "tipo": "peca", "imagem": "porta_rx7.png" }
    ]
};

const shopInventory = {
    "itens": [
        { "id": "leite", "quantiadde": 10, "peso": 1, "nome": "Leite de Com Toddy", "tipo": "bebida", "preco": 10, "imagem": "leite.png" },
        { "id": "big_mac", "quantiadde": 5, "peso": 1, "nome": "Big Mac", "tipo": "comida", "preco": 15, "imagem": "bigmac.png" }
    ]
};

let draggedItem = null;
let actionType = '';

function renderInventory(inventory, elementId, selectedElementId) {
    const inventoryElement = document.getElementById(elementId);
    const selectedElement = document.getElementById(selectedElementId);
    inventoryElement.innerHTML = '';
    selectedElement.innerHTML = ''; // Limpa o nome selecionado

    inventory.itens.forEach(item => {
        const itemDiv = document.createElement('div');
        itemDiv.className = 'item';
        itemDiv.draggable = true;
        itemDiv.innerHTML = `
            <img src="${item.imagem}" alt="${item.id}">
            <div class="item-name">${item.nome}</div>
            <p>${item.quantiadde}</p>
        `;
        itemDiv.addEventListener('dragstart', () => {
            draggedItem = item;
            selectedElement.innerHTML = item.nome; // Mostra o nome do item selecionado
        });
        inventoryElement.appendChild(itemDiv);
    });
}

document.addEventListener('DOMContentLoaded', () => {
    renderInventory(playerInventory, 'player-inventory', 'selected-player-item');
    renderInventory(shopInventory, 'shop-inventory', 'selected-shop-item');

    document.querySelectorAll('.action-button').forEach(button => {
        button.addEventListener('click', () => {
            actionType = button.id; // Captura o tipo de ação
            $('#quantityModal').modal('show'); // Mostra o modal
        });
    });

    document.getElementById('confirm-quantity').addEventListener('click', () => {
        const quantity = document.getElementById('item-quantity').value;
        if (quantity) {
            handleAction(actionType, quantity);
            $('#quantityModal').modal('hide');
        }
    });
});

function handleAction(action, quantity) {
    if (action === 'buy-sell') {
        console.log(`Comprado/Vendido: ${draggedItem.nome} - Quantidade: ${quantity}`);
    } else if (action === 'use') {
        console.log(`Usado: ${draggedItem.nome} - Quantidade: ${quantity}`);
    } else if (action === 'discard') {
        console.log(`Descartado: ${draggedItem.nome} - Quantidade: ${quantity}`);
    }
}
