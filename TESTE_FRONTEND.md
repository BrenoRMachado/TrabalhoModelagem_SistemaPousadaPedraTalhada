# 🧪 GUIA DE TESTE - FRONTEND COMPLETO

## ✅ Sistema de Gerenciamento Dinâmico de Quartos Implementado

### 🎯 Funcionalidades Testáveis

O frontend agora possui **gerenciamento dinâmico de estado dos quartos** com as seguintes funcionalidades:

1. **Dashboard com Quartos em Tempo Real** — Cores mudam baseado no status
2. **Nova Reserva** — Marca quarto como OCUPADO (vermelho)
3. **Checkout** — Libera quarto para DISPONÍVEL (verde)
4. **Persistência** — Dados salvos em localStorage durante a sessão

---

## 🚀 Fluxo de Teste Recomendado

### **TESTE 1: Visualizar Dashboard Inicial**

```
1. Abra: http://localhost/pousada/app/views/admin/login.html
2. Clique em "Entrar"
3. Você será direcionado ao Dashboard
4. Observe os quartos:
   - 🟢 VERDE (Disponível): 101, 104, 202, 301
   - 🔴 VERMELHO (Ocupado): 102, 201, 302
   - 🟡 AMARELO (Manutenção): 103
```

**Status Esperado:** ✅ Dashboard mostra 8 quartos com cores corretas

---

### **TESTE 2: Criar uma Reserva (Marcar Quarto como Ocupado)**

```
1. No Dashboard, clique em "Reservas" (sidebar)
2. Clique em "Nova Reserva" (botão verde)
3. Preencha o formulário:
   - Data Entrada: 03/01/2026
   - Data Saída: 05/01/2026
   - Quarto: Selecione "202" (está VERDE/Disponível)
   - Nome: Digite qualquer nome (ex: "Teste Cliente")
   - CPF: 123.456.789-00
   - Email: teste@email.com
   - Telefone: (11) 99999-9999
4. Clique em "Salvar Reserva"
5. Voltará para Reservas com mensagem de sucesso
```

**Status Esperado:** ✅ Quarto 202 foi marcado como OCUPADO no RoomManager

---

### **TESTE 3: Verificar Mudança de Status no Dashboard**

```
1. Clique em "Dashboard" (sidebar)
2. Procure pelo Quarto 202
3. Observe a cor dele
```

**Status Esperado:** ✅ Quarto 202 agora deve estar 🔴 VERMELHO (Ocupado)
- Ícone: 👤 pessoa
- Texto: "Ocupado"
- Nome do Hóspede: "Teste Cliente"

---

### **TESTE 4: Fazer Checkout (Liberar Quarto para Disponível)**

```
1. No Dashboard ou Reservas, clique na ação "Checkout" do quarto 202
2. Na página de Checkout:
   - Revise os dados da reserva
   - Escolha forma de pagamento (ex: "Dinheiro")
   - Se escolheu dinheiro, preencha "Valor Recebido": 600
   - Clique em "Confirmar Checkout"
3. Você receberá confirmação com mensagem do quarto liberado
4. Será redirecionado para o Dashboard
```

**Status Esperado:** ✅ Confirmação mostra "Quarto 202 - LIBERADO"

---

### **TESTE 5: Verificar Quarto Liberado no Dashboard**

```
1. Após o checkout, você estará no Dashboard
2. Procure pelo Quarto 202
```

**Status Esperado:** ✅ Quarto 202 agora deve estar 🟢 VERDE (Disponível)
- Ícone: 🚪 porta
- Texto: "Disponível"
- Tipo: "Standard"

---

## 📊 Quartos Padrão para Teste

| Quarto | Tipo | Status Inicial | Hóspede |
|--------|------|---|---|
| 101 | Standard | 🟢 Disponível | -- |
| 102 | Standard | 🔴 Ocupado | Maria Silva |
| 103 | Standard | 🟡 Manutenção | -- |
| 104 | Luxo | 🟢 Disponível | -- |
| 201 | Duplo | 🔴 Ocupado | João Santos |
| 202 | Standard | 🟢 Disponível | -- |
| 301 | Suite | 🟢 Disponível | -- |
| 302 | Suite | 🔴 Ocupado | Ana Costa |

---

## 🔄 Teste de Ciclo Completo

**Para fazer um ciclo completo de operação:**

### Ciclo 1: 101 (Disponível → Ocupado → Disponível)
```
Dashboard → Nova Reserva (101) → Checkout → Dashboard (101 muda de 🟢 para 🔴 para 🟢)
```

### Ciclo 2: 104 (Disponível → Ocupado → Disponível)
```
Dashboard → Nova Reserva (104) → Checkout → Dashboard (104 muda de 🟢 para 🔴 para 🟢)
```

---

## 🛠️ Ferramentas de Teste no Console

Você pode usar o console do navegador (F12) para testar comandos:

### Verificar estado atual dos quartos
```javascript
RoomManager.getAllRooms()
```

### Obter estatísticas
```javascript
RoomManager.getStatistics()
```

### Ocupar um quarto manualmente
```javascript
RoomManager.occupyRoom('301', 'Cliente Teste')
```

### Liberar um quarto manualmente
```javascript
RoomManager.releaseRoom('301')
```

### Resetar todos os quartos para estado inicial
```javascript
RoomManager.resetRooms()
```

---

## ✨ Funcionalidades Implementadas

### ✅ Página de Login
- Autenticação básica
- Redirecionamento para Dashboard

### ✅ Dashboard
- Renderização dinâmica de quartos
- Cores baseadas em status (Verde/Vermelho/Amarelo)
- Ícones Material Icons
- Nomes de hóspedes mostrados

### ✅ Reservas
- Listagem com filtros funcionando
- Tabela responsiva
- Botões de ação (Check-in, Editar, Cancelar, Checkout)

### ✅ Nova Reserva
- Formulário com validação
- Seleção de quarto com preço automático
- Cálculo de diárias e total
- Integração com RoomManager para marcar como ocupado

### ✅ Checkout
- Resumo completo da hospedagem
- Cálculo de troco
- Múltiplas formas de pagamento
- Integração com RoomManager para liberar quarto

### ✅ Hóspedes
- CRUD com modal
- Filtros e busca

### ✅ Financeiro
- Gráficos com Chart.js
- Filtros por período
- Tabela de transações

### ✅ Equipe e Acessos
- Gerenciamento de usuários
- Controle de permissões
- Cargos: Gerente e Recepcionista

---

## 🎨 Design & Responsividade

- ✅ Layout responsivo (mobile-first)
- ✅ Cores consistentes (#5D4037 marrom, #00C853 verde, #FF3D00 vermelho, #FFAB00 amarelo)
- ✅ Ícones Material Design
- ✅ Sidebar navegável
- ✅ Modais funcionais
- ✅ Validação de formulários

---

## 📝 Próximos Passos (Backend)

Quando conectar ao backend PHP/MySQL:

1. **Persistência de Dados** — Salvar em banco em vez de localStorage
2. **Autenticação Real** — Login com credenciais verificadas
3. **API REST** — Endpoints para CRUD
4. **Validação de Servidor** — Regras de negócio no backend
5. **Notificações em Tempo Real** — WebSockets para múltiplos usuários

---

## 🐛 Troubleshooting

### Problema: Quartos não estão mudando de cor
**Solução:** Abra o console (F12) e limpe localStorage:
```javascript
localStorage.clear()
location.reload()
```

### Problema: Dados não persistem entre páginas
**Solução:** localStorage é limitado à sessão do navegador. Recarregue a página.

### Problema: Ícones não aparecem
**Solução:** Verifique conexão com Google Fonts e Material Icons

---

## ✅ Checklist de Teste

- [ ] Login funciona e redireciona para Dashboard
- [ ] Dashboard mostra 8 quartos com cores corretas
- [ ] Nova Reserva marca quarto como OCUPADO (muda para vermelho)
- [ ] Checkout libera quarto (muda para verde)
- [ ] Filtros e buscas funcionam em todas as tabelas
- [ ] Modais abrem e fecham corretamente
- [ ] Cálculos automáticos funcionam (diárias, total, troco)
- [ ] Layout é responsivo no mobile (teste com F12)
- [ ] Todos os links de navegação funcionam
- [ ] Formulários validam campos obrigatórios

---

**Data:** 03/01/2026  
**Status:** ✅ Pronto para Testes Completos!
