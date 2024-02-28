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
    // remocao(unidade_produto_id) {
    //   this.loading = true
    //
    //   this.router().delete(`deletar/${unidade_produto_id}`)
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
    produtos: {
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
      <div class="container-listagem-produto">
        <h2>
          Aqui, você vai ver seus produtos cadastrados e poderá editá-los, excluí-los ou criar
          novos produtos.
        </h2>
        <div class="container-cadastro-produto">
          <v-btn
              prepend-icon="fas fa-plus"
              class="criar"
              variant="tonal"
              @click="$router.push({ path: 'cadastro' })"
          >Criar</v-btn
          >
        </div>
        <v-table
            density="compact"
            fixed-header
            height="400"
            v-if="produtos.length != 0"
            class="tabela-produtos"
        >
          <thead>
          <tr>
            <th class="text-left">ID</th>
            <th class="text-left">Nome</th>
            <th class="text-left">Estoque</th>
            <th class="text-left">Preço de Venda</th>
            <th class="text-left">Ações</th>
          </tr>
          </thead>
          <tbody>
          <tr v-for="produto in produtos" :key="produto.produto_id">
            <td>{{ produto.produto_id }}</td>
            <td>{{ produto.produto_nome }}</td>
            <td>{{ produto.produto_estoque }}</td>
            <td>R$ {{ produto.produto_preco }}</td>
            <td class="acoes">
              <v-btn
                  density="compact"
                  icon="fas fa-magic"
                  variant="flat"
                  @click="$router.push({ path: `edicao/${produto.produto_id}` })"
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
                  <v-card title="Remoção da produto de medida do produto">
                    <v-card-text> Você deseja remover este produto? </v-card-text>
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
                          @click="remocao(produto.produto_id)"
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
      <h2 class="sem-grupos" v-if="produtos.length == 0">Sem produtos cadastrados</h2>
    </v-main>
  </v-layout>
</template>

<style scoped>
.container-listagem-produto {
  padding: 4rem;
  font-family: 'Poppins', sans-serif;
  width: 90%;
}

.container-cadastro-produto {
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