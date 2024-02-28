<script>
import LoadingComponent from "@/components/Uteis/LoadingComponent.vue";
import NotificacaoComponent from "@/components/Uteis/NotificacaoComponent.vue";
import NavbarSistemaComponent from "@/components/Navbar/NavbarSistemaComponent.vue";
import {router} from "@inertiajs/vue3";
export default {
  methods: {
    router() {
      return router
    },
    // remocao(subgrupo_produto_id) {
    //   this.loading = true
    //
    //   this.router().delete(`deletar/${subgrupo_produto_id}`)
    //
    //   this.loading = false
    // }
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
  props: {
    menus: {
      type: Array,
      required: true
    },
    subMenus: {
      type: Array,
      required: true
    },
    unidades: {
      type: Array,
      required: true
    }
  },
}
</script>

<template>
  <v-layout>
    <NavbarSistemaComponent :menus="menus" :subMenus="subMenus" />
    <NotificacaoComponent
        :notificacao="this.$page.props.flash.backendFlashMessage"
        v-if="this.$page.props.flash.backendFlashMessage"
    />
    <LoadingComponent :loading="loading" />
    <v-main>
      <div class="container-listagem-unidade">
        <h2>
          Aqui, você vai ver suas unidades de medida cadastrados e poderá editá-los, excluí-los ou criar
          novas unidades de medida.
        </h2>
        <div class="container-cadastro-unidade">
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
            v-if="unidades.length != 0"
            class="tabela-unidades"
        >
          <thead>
          <tr>
            <th class="text-left">ID</th>
            <th class="text-left">Nome</th>
            <th class="text-left">Sigla</th>
            <th class="text-left">Ações</th>
          </tr>
          </thead>
          <tbody>
          <tr v-for="unidade in unidades" :key="unidade.unidade_produto_id">
            <td>{{ unidade.unidade_produto_id }}</td>
            <td>{{ unidade.unidade_produto_nome }}</td>
            <td>{{ unidade.unidade_produto_sigla }}</td>
            <td class="acoes">
              <v-btn
                  density="compact"
                  icon="fas fa-magic"
                  variant="flat"
                  @click="$router.push({ path: `edicao/${unidade.unidade_produto_id}` })"
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
                  <v-card title="Remoção da unidade de medida do produto">
                    <v-card-text> Você deseja remover esta unidade de medida do produto? </v-card-text>
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
                          @click="remocao(unidade.unidade_produto_id)"
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
      <h2 class="sem-grupos" v-if="unidades.length == 0">Sem unidades de medida cadastrados</h2>
    </v-main>
  </v-layout>
</template>

<style scoped>
.container-listagem-unidade {
  padding: 4rem;
  font-family: 'Poppins', sans-serif;
  width: 90%;
}

.container-cadastro-unidade {
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