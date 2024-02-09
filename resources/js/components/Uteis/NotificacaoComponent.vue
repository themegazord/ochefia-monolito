<template>
  <div class="container-notificacao">
    <transition name="fade">
        <div class="notificacao" :class="setTipoNotificacao(notificacao.tipo)">
            <p class="titulo-notificacao">{{ notificacao.titulo }}</p>
            <p class="conteudo-notificacao">{{ notificacao.notificacao }}</p>
        </div>
    </transition>
  </div>
</template>
<script>
export default {
    props: {
        notificacao: {
            type: Object,
            required: true
        }
    },
    methods: {
        setTipoNotificacao(tipo) {
            if (tipo == 'sucesso') {
                return { 'sucesso': true }
            } else if (tipo == 'info') {
                return { 'info': true }
            } else {
                return { 'erro': true }
            }
        }
    }
}
</script>

<style scoped>
.info {
    background-color: var(--dodger-blue);
}
.erro {
    background-color: var(--vermilion);
}
.sucesso {
    background-color: var(--green-confirm);
}
.container-notificacao {
    position: absolute;
    right: 0;
    top: 1;
    display: flex;
    flex-direction: column;
    gap: 1rem;
    width: 20%;
    z-index: 10000;
}
.notificacao {
    width: 90%;
    padding: 1rem;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    border-radius: 10px;
}

.conteudo-notificacao,
.titulo-notificacao {
    font-family: 'Poppins', sans-serif;
    color: var(--platinum);
}

.fade-enter-active, .fade-leave-active {
    transition: opacity 0.5s;
}
.fade-enter, .fade-leave-to {
    opacity: 0;
}

</style>
