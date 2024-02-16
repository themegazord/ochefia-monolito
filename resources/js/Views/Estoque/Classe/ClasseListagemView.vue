<script>
import NavbarSistemaComponent from "@/components/Navbar/NavbarSistemaComponent.vue";
import LoadingComponent from "@/components/Uteis/LoadingComponent.vue";
import NotificacaoComponent from "@/components/Uteis/NotificacaoComponent.vue";
import {router} from "@inertiajs/vue3";
export default {
  methods: {
    router() {
      return router
    }
  },
  components: {
    NavbarSistemaComponent,
    LoadingComponent,
    NotificacaoComponent
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
    classes: {
      type: Array,
      required: true
    }
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
    <NavbarSistemaComponent :menus="menus" :subMenus="subMenus" />
    <LoadingComponent :loading="loading"/>
    <NotificacaoComponent
        :notificacao="this.$page.props.flash.backendFlashMessage"
        v-if="this.$page.props.flash.backendFlashMessage"
    />
    <v-main>
      <div class="container-listagem-classe">
        <h2>
          Aqui, você vai ver suas classes cadastradas e poderá editá-las, excluí-las ou criar novas
          classes.
        </h2>
        <div class="container-cadastro-classe">
          <v-btn
              prepend-icon="fas fa-plus"
              class="criar"
              variant="tonal"
              @click="router().get('cadastro')"
          >Criar</v-btn
          >
        </div>
        <v-table
            density="compact"
            fixed-header
            height="400"
            v-if="classes.length !== 0"
            class="tabela-classes"
        >
          <thead>
          <tr>
            <th class="text-left">ID</th>
            <th class="text-left">Nome</th>
            <th class="text-left">Ações</th>
          </tr>
          </thead>
          <tbody>
          <tr v-for="classe in classes" :key="classe.classe_produto_id">
            <td>{{ classe.classe_produto_id }}</td>
            <td>{{ classe.classe_produto_nome }}</td>
            <td class="acoes">
              <v-btn
                  density="compact"
                  icon="fas fa-magic"
                  variant="flat"
                  @click="router().get(`edicao/${classe.classe_produto_id}`)"
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
                  <v-card title="Remoção de grupo de produto">
                    <v-card-text> Você deseja remover este grupo de produto? </v-card-text>
                    <v-card-actions>
                      <v-spacer></v-spacer>
                      <v-btn
                          text="Cancelar"
                          @click="isActive.value = false"
                          :disabled="indisponivel"
                          color="var(--green-confirm)" variant="tonal"
                      ></v-btn>
                      <v-btn
                          text="Remover"
                          @click="remocaoClasseProduto(classe.classe_produto_id)"
                          variant="tonal"
                          color="var(--vermilion)"
                          :disabled="indisponivel"
                          prepend-icon="fas fa-trash"
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
      <h2 class="sem-grupos" v-if="classes.length == 0">Sem classes cadastrados</h2>
    </v-main>
  </v-layout>
</template>

<style scoped>
.container-listagem-classe {
  padding: 4rem;
  font-family: 'Poppins', sans-serif;
  width: 90%;
}

.container-cadastro-classe {
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