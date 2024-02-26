<script>
import NavbarSistemaComponent from "@/components/Navbar/NavbarSistemaComponent.vue";
import NotificacaoComponent from "@/components/Uteis/NotificacaoComponent.vue";
import LoadingComponent from "@/components/Uteis/LoadingComponent.vue";
import {helpers, maxLength, required} from "@vuelidate/validators";
import {useVuelidate} from "@vuelidate/core";
import {router} from "@inertiajs/vue3";

export default {
  setup() {
    return {
      v$: useVuelidate()
    }
  },
  components: {
    NavbarSistemaComponent,
    NotificacaoComponent,
    LoadingComponent
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
    tiposGrupo: {
      type: Object,
      required: true
    }
  },
  mounted() {
    for(let index in Object.assign({}, this.tiposGrupo)) {
      this.tipos.push({
        tipo: this.tiposGrupo[index],
        tipo_abbr: index
      })
    }
  },
  data() {
    return {
      loading: false,
      tipos: [],
      grupo: {
        grupo_produto_nome: '',
        grupo_produto_tipo: ''
      }
    }
  },
  methods: {
    async cadastrar() {
      if (await this.v$.grupo.$validate()) {
        this.loading = true
        router.post('cadastrar', this.grupo)
        this.loading = false
      }
    }
  },
  validations() {
    return {
      grupo: {
        grupo_produto_nome: {
          required: helpers.withMessage('O campo do nome do produto é obrigatório', required),
          maxLength: helpers.withMessage('O nome deve conter até 30 caracteres', maxLength(30))
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
      <div class="container-cadastro-grupo">
        <h2>Aqui você poderá cadastrar novos grupos de produtos!</h2>
        <form class="form-cadastro-grupo" @submit.prevent="cadastrar">
          <v-row>
            <v-col cols="6">
              <v-text-field
                  type="text"
                  v-model="grupo.grupo_produto_nome"
                  :error-messages="v$.grupo.grupo_produto_nome.$errors.map((e) => e.$message)"
                  counter="30"
                  label="Insira o nome do grupo"
                  @input="v$.grupo.grupo_produto_nome.$touch"
                  @blur="v$.grupo.grupo_produto_nome.$touch"
              ></v-text-field
              >
            </v-col>
            <v-col cols="6">
              <v-select
                  :items="tipos"
                  item-title="tipo"
                  item-value="tipo_abbr"
                  label="Insira o tipo do grupo"
                  v-model="grupo.grupo_produto_tipo"
              ></v-select
              >
            </v-col>
          </v-row>
          <v-row>
            <v-col cols="12" class="botoes">
              <v-btn variant="tonal" @click="$router.go(-1)" color="var(--vermilion)"
              >Voltar
              </v-btn
              >
              <v-btn variant="tonal" type="submit" color="var(--green-confirm)"
              >Salvar
              </v-btn
              >
            </v-col>
          </v-row>
        </form>
      </div>
    </v-main>
  </v-layout>
</template>

<style scoped>
.container-cadastro-grupo {
  padding: 4rem;
  font-family: 'Poppins', sans-serif;
  width: 90%;
}

.form-cadastro-grupo {
  padding: 3rem;
}

.botoes {
  display: flex;
  gap: 1rem;
  justify-content: end;
}
</style>