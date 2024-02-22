<script>
import NavbarSistemaComponent from "@/components/Navbar/NavbarSistemaComponent.vue";
import NotificacaoComponent from "@/components/Uteis/NotificacaoComponent.vue";
import LoadingComponent from "@/components/Uteis/LoadingComponent.vue";
import {router} from "@inertiajs/vue3";

export default {
  methods: {
    router() {
      return router
    },
    remocao(fabricante_produto_id) {
      this.loading = true
      this.router().delete(`deletar/${fabricante_produto_id}`)
      this.loading = false
    }
  },
  props: {
    menus: {
      type: Array,
      required: true
    },
    subMenus: {
      type: Array,
      required: true
    },
    fabricantes: {
      type: Array,
      required: true
    }
  },
  components: {
    LoadingComponent,
    NotificacaoComponent,
    NavbarSistemaComponent
  },
  data() {
    return {
      loading: false
    }
  },
}
</script>

<template>
  <v-layout>
    <NavbarSistemaComponent :menus="menus" :subMenus="subMenus"/>
    <NotificacaoComponent
        :notificacao="this.$page.props.flash.backendFlashMessage"
        v-if="this.$page.props.flash.backendFlashMessage"
    />
    <LoadingComponent :loading="loading"/>
    <v-main>
      <div class="container-listagem-fabricante">
        <h2>
          Aqui, você vai ver seus fabricantes cadastrados e poderá editá-los, excluí-los ou criar
          novos fabricantes.
        </h2>
        <div class="container-cadastro-fabricante">
          <v-btn
              prepend-icon="fas fa-plus"
              class="criar"
              variant="tonal"
              @click="router().get('cadastro')"
          >Criar
          </v-btn
          >
        </div>
        <v-table
            density="compact"
            fixed-header
            height="400"
            v-if="fabricantes.length != 0"
            class="tabela-fabricantes"
        >
          <thead>
          <tr>
            <th class="text-left">ID</th>
            <th class="text-left">Nome</th>
            <th class="text-left">Ações</th>
          </tr>
          </thead>
          <tbody>
          <tr v-for="fabricante in fabricantes" :key="fabricante.fabricante_produto_id">
            <td>{{ fabricante.fabricante_produto_id }}</td>
            <td>{{ fabricante.fabricante_produto_nome }}</td>
            <td class="acoes">
              <v-btn
                  density="compact"
                  icon="fas fa-magic"
                  variant="flat"
                  @click="router().get(`edicao/${fabricante.fabricante_produto_id}`)"
              ></v-btn>
              <v-dialog width="500">
                <template v-slot:activator="{ props }">
                  <v-btn
                      density="compact"
                      icon="fas fa-trash"
                      variant="flat"
                      v-bind="props"
                  ></v-btn>
                </template>

                <template v-slot:default="{ isActive }">
                  <v-card title="Remoção de fabricante de produto">
                    <v-card-text> Você deseja remover este fabricante de produto?</v-card-text>
                    <v-card-actions>
                      <v-spacer></v-spacer>
                      <v-btn
                          text="Cancelar"
                          @click="isActive.value = false"
                          color="var(--green-confirm)"
                          variant="tonal"
                      ></v-btn>
                      <v-btn
                          text="Remover"
                          @click="remocao(fabricante.fabricante_produto_id)"
                          variant="tonal"
                          prepend-icon="fas fa-trash"
                          :disabled="removido"
                          color="var(--vermilion)"
                      ></v-btn>
                    </v-card-actions>
                  </v-card>
                </template>
              </v-dialog>
            </td>
          </tr>
          </tbody>
        </v-table>
      </div>
      <h2 class="sem-grupos" v-if="fabricantes.length == 0">Sem fabricantes cadastrados</h2>
    </v-main>
  </v-layout>
</template>

<style scoped>
.container-listagem-fabricante {
  padding: 4rem;
  font-family: 'Poppins', sans-serif;
  width: 90%;
}

.container-cadastro-fabricante {
  display: flex;
  justify-content: end;
  padding: 3rem 0;
}

.criar {
  color: var(--green-confirm);
}

.acoes {
  display: flex;
  gap: 0.5rem;
}
</style>