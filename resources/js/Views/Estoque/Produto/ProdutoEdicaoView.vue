<script>
import LoadingComponent from "@/components/Uteis/LoadingComponent.vue";
import NotificacaoComponent from "@/components/Uteis/NotificacaoComponent.vue";
import NavbarSistemaComponent from "@/components/Navbar/NavbarSistemaComponent.vue";
import {router} from "@inertiajs/vue3";
import {helpers, maxLength, required} from "@vuelidate/validators";
import {useVuelidate} from "@vuelidate/core";
export default {
  setup() {
    return {
      v$: useVuelidate()
    }
  },
  methods: {
    router() {
      return router
    },
    editar() {
      this.loading = true
      this.router().put(`/${this.$page.url.substring(1, 15)}/estoque/produto/editar/${this.produto.produto_id}`, this.produto)
      this.loading = false
    }
  },
  components: {
    LoadingComponent,
    NotificacaoComponent,
    NavbarSistemaComponent
  },
  data() {
    return {
      loading: false,
      grupos: [],
      subgrupos: [],
      fabricantes: [],
      classes: [],
      unidades: [],
      produto: {
        grupo_produto_id: undefined,
        subgrupo_produto_id: undefined,
        fabricante_produto_id: undefined,
        classe_produto_id: undefined,
        unidade_produto_id: undefined,
        produto_nome: '',
        produto_estoque: 0.0,
        produto_preco: 0.0
      },
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
    dadosParaCadastro: {
      type: Object,
      required: true
    },
    produtoBanco: {
      type: Object,
      required: true
    }
  },
  mounted() {
    this.loading = true
    let novoObjDadosParaCadastro = Object.assign({}, this.dadosParaCadastro)
    this.grupos = novoObjDadosParaCadastro.grupos
    this.subgrupos = novoObjDadosParaCadastro.subgrupos
    this.classes = novoObjDadosParaCadastro.classes
    this.fabricantes = novoObjDadosParaCadastro.fabricantes
    this.unidades = novoObjDadosParaCadastro.unidades
    this.produto = {...this.produtoBanco}
    this.loading = false
  },
  validations() {
    return {
      produto: {
        produto_nome: {
          required: helpers.withMessage(
              'Esse campo é obrigatório, por favor, informe-o.',
              required
          ),
          maxLength: helpers.withMessage(
              'Esse campo tem que conter no máximo 155 caracteres.',
              maxLength(155)
          )
        },
        produto_preco: {
          required: helpers.withMessage('Esse campo é obrigatório, por favor, informe-o.', required)
        },
        produto_estoque: {
          required: helpers.withMessage('Esse campo é obrigatório, por favor, informe-o.', required)
        }
      }
    }
  }
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
      <div class="container-cadastro-produto">
        <h2>Aqui você poderá editar seus produtos!</h2>
        <form class="form-cadastro-produto" @submit.prevent="editar">
          <v-row>
            <v-col cols="6">
              <v-text-field
                  type="text"
                  v-model="produto.produto_nome"
                  :error-messages="v$.produto.produto_nome.$errors.map((e) => e.$message)"
                  counter="90"
                  label="Insira o nome do produto"
                  @input="v$.produto.produto_nome.$touch"
                  @blur="v$.produto.produto_nome.$touch"
              ></v-text-field
              >
            </v-col>
            <v-col cols="6">
              <v-text-field
                  prefix="R$"
                  v-model="produto.produto_preco"
                  label="Insira o preço do produto"
                  :error-messages="v$.produto.produto_preco.$errors.map((e) => e.$message)"
                  @input="v$.produto.produto_preco.$touch"
                  @blur="v$.produto.produto_preco.$touch"
                  type="number"
                  min="0"
                  step="0.01"
                  pattern="^\d+(?:[\.\,]\d{1,2})?$"
              ></v-text-field>
            </v-col>
          </v-row>
          <v-row>
            <v-col cols="6">
              <v-text-field
                  v-model="produto.produto_estoque"
                  label="Insira o estoque do produto"
                  :error-messages="v$.produto.produto_estoque.$errors.map((e) => e.$message)"
                  @input="v$.produto.produto_estoque.$touch"
                  @blur="v$.produto.produto_estoque.$touch"
                  type="number"
                  min="0"
                  step="0"
                  disabled
              ></v-text-field>
            </v-col>
            <v-col cols="6">
              <v-select
                  :items="grupos"
                  item-title="grupo_produto_nome"
                  item-value="grupo_produto_id"
                  label="Insira o seu grupo"
                  v-model="produto.grupo_produto_id"
              ></v-select>
            </v-col>
          </v-row>
          <v-row>
            <v-col cols="6">
              <v-select
                  :items="subgrupos"
                  item-title="subgrupo_produto_nome"
                  item-value="subgrupo_produto_id"
                  label="Insira o sub grupo"
                  v-model="produto.subgrupo_produto_id"
              ></v-select>
            </v-col>
            <v-col cols="6">
              <v-select
                  :items="fabricantes"
                  item-title="fabricante_produto_nome"
                  item-value="fabricante_produto_id"
                  label="Insira o fabricante"
                  v-model="produto.fabricante_produto_id"
              ></v-select>
            </v-col>
          </v-row>
          <v-row>
            <v-col cols="6">
              <v-select
                  :items="classes"
                  item-title="classe_produto_nome"
                  item-value="classe_produto_id"
                  label="Insira a classe do produto"
                  v-model="produto.classe_produto_id"
              ></v-select>
            </v-col>
            <v-col cols="6">
              <v-select
                  :items="unidades"
                  item-title="unidade_produto_nome"
                  item-value="unidade_produto_id"
                  label="Insira a unidade de medida"
                  v-model="produto.unidade_produto_id"
              ></v-select>
            </v-col>
          </v-row>
          <v-row>
            <v-col cols="12" class="botoes">
              <v-btn variant="tonal" @click="$router.go(-1)" color="var(--vermilion)">Voltar</v-btn>
              <v-btn variant="tonal" type="submit" color="var(--green-confirm)">Salvar</v-btn>
            </v-col>
          </v-row>
        </form>
      </div>
    </v-main>
  </v-layout>
</template>

<style scoped>
.container-cadastro-produto {
  padding: 4rem;
  font-family: 'Poppins', sans-serif;
  width: 90%;
}

.form-cadastro-produto {
  padding: 3rem;
}

.botoes {
  display: flex;
  gap: 1rem;
  justify-content: end;
}
</style>