<script>
import LoadingComponent from "@/components/Uteis/LoadingComponent.vue";
import NavbarComponent from "@/components/Navbar/NavbarComponent.vue";
import NotificacaoComponent from "@/components/Uteis/NotificacaoComponent.vue";
import {
  helpers,
  required,
  maxLength,
  email,
  sameAs,
} from "@vuelidate/validators";
import { router, useForm } from "@inertiajs/vue3";
import { useVuelidate } from "@vuelidate/core";
import { validaCPF } from "@/utils/validaCPF";
import { validaCNPJ } from "@/utils/validaCNPJ";
export default {
  setup() {
    return {
      v$: useVuelidate(),
      cliente: useForm({
        cliente_nome: "",
        cliente_email: "",
        cliente_cpf: "",
        cliente_senha: "",
        cliente_senha_confirmacao: "",
        cliente_telefone_pessoal: "",
        cliente_telefone_contato: "",
      }),
      empresa: useForm({
        nome: "",
        cnpj: "",
        descricao: "",
        logo: null,
      }),
      dono: useForm({
        nome: "",
        email: "",
        senha: "",
        senhaVerificacao: "",
      }),
    };
  },
  components: {
    NavbarComponent,
    LoadingComponent,
    NotificacaoComponent,
  },
  props: {
    links: {
      type: Object,
      required: true,
    },
    errors: Object,
  },
  data() {
    return {
      loading: false,
      escolhamodalidade: "cliente",
      descricao: ["Bar", "Mercearia", "Restaurante", "Mercado", "Outros"],
      ativaNotificacao: false,
      notificacao: {
        tipo: null,
        titulo: null,
        notificacao: null,
      },
    };
  },
  methods: {
    cadastro() {
      if (this.escolhamodalidade == "cliente") {
        router.post("/cliente/cadastro", this.cliente);
      }
    },
  },
  validations() {
    return {
      cliente: {
        cliente_nome: {
          required: helpers.withMessage(
            "O campo de nome é obrigatório.",
            required
          ),
          maxLength: helpers.withMessage(
            "O nome deve conter até 255 caracteres.",
            maxLength(255)
          ),
        },
        cliente_email: {
          required: helpers.withMessage(
            "O campo de nome é obrigatório.",
            required
          ),
          maxLength: helpers.withMessage(
            "O email deve conter até 255 caracteres",
            maxLength(255)
          ),
          email: helpers.withMessage("O email é inválido", email),
        },
        cliente_cpf: {
          required: helpers.withMessage(
            "O campo de nome é obrigatório.",
            required
          ),
          maxLength: helpers.withMessage(
            "O email deve conter até 255 caracteres",
            maxLength(11)
          ),
          validaCPF: helpers.withMessage("CPF inválido", validaCPF),
        },
        cliente_senha: {
          required: helpers.withMessage(
            "O campo de nome é obrigatório.",
            required
          ),
          maxLength: helpers.withMessage(
            "O email deve conter até 255 caracteres",
            maxLength(255)
          ),
        },
        cliente_senha_confirmacao: {
          required: helpers.withMessage(
            "O campo de nome é obrigatório.",
            required
          ),
          maxLength: helpers.withMessage(
            "O email deve conter até 255 caracteres",
            maxLength(255)
          ),
          sameAs: helpers.withMessage(
            "A senha e a confirmação devem ser as mesmas",
            sameAs(this.cliente.cliente_senha)
          ),
        },
        cliente_telefone_pessoal: {
          required: helpers.withMessage(
            "O campo de nome é obrigatório.",
            required
          ),
          maxLength: helpers.withMessage(
            "O email deve conter até 255 caracteres",
            maxLength(20)
          ),
        },
        cliente_telefone_contato: {
          required: helpers.withMessage(
            "O campo de nome é obrigatório.",
            required
          ),
          maxLength: helpers.withMessage(
            "O email deve conter até 255 caracteres",
            maxLength(20)
          ),
        },
      },
      dono: {
        nome: {
          required: helpers.withMessage(
            "O campo de nome é obrigatório.",
            required
          ),
          maxLength: helpers.withMessage(
            "O nome deve conter até 255 caracteres.",
            maxLength(255)
          ),
        },
        email: {
          required: helpers.withMessage(
            "O campo de nome é obrigatório.",
            required
          ),
          maxLength: helpers.withMessage(
            "O email deve conter até 255 caracteres",
            maxLength(255)
          ),
          email: helpers.withMessage("O email é inválido", email),
        },
        senha: {
          required: helpers.withMessage(
            "O campo de nome é obrigatório.",
            required
          ),
          maxLength: helpers.withMessage(
            "O email deve conter até 255 caracteres",
            maxLength(255)
          ),
        },
        senhaVerificacao: {
          required: helpers.withMessage(
            "O campo de nome é obrigatório.",
            required
          ),
          maxLength: helpers.withMessage(
            "O email deve conter até 255 caracteres",
            maxLength(255)
          ),
          sameAs: helpers.withMessage(
            "A senha e a confirmação devem ser as mesmas",
            sameAs(this.dono.senha)
          ),
        },
      },
      empresa: {
        nome: {
          required: helpers.withMessage(
            "O campo de nome é obrigatório.",
            required
          ),
          maxLength: helpers.withMessage(
            "O nome deve conter até 255 caracteres.",
            maxLength(255)
          ),
        },
        cnpj: {
          required: helpers.withMessage(
            "O campo de nome é obrigatório.",
            required
          ),
          maxLength: helpers.withMessage(
            "O nome deve conter até 14 caracteres.",
            maxLength(14)
          ),
          validaCNPJ: helpers.withMessage("CNPJ inválido", validaCNPJ),
        },
      },
    };
  },
};
</script>

<template>
  <NavbarComponent :links="links" />
  <main>
    <LoadingComponent :loading="loading" />
    <NotificacaoComponent
      :notificacao="this.$page.props.flash.backendFlashMessage"
      v-if="this.$page.props.flash.backendFlashMessage"
    />
    <div class="container-cadastro">
      <form @submit.prevent="cadastro" class="form-cadastro">
        <p class="text-center">Escolha sua modalidade:</p>
        <v-container class="escolha-modalidade">
          <label for="sou-cliente" class="escolha-label">
            <input
              type="radio"
              name="sou-cliente"
              id="sou-cliente"
              value="cliente"
              tabindex="1"
              v-model="escolhamodalidade"
            />
            <span> Sou cliente</span>
          </label>
          <label for="sou-dono" class="escolha-label">
            <input
              type="radio"
              name="sou-dono"
              id="sou-dono"
              value="dono"
              tabindex="2"
              v-model="escolhamodalidade"
            />
            <span> Sou dono</span>
          </label>
        </v-container>
        <v-row>
          <v-col cols="6">
            <v-text-field
              v-if="escolhamodalidade == 'cliente'"
              v-model="cliente.cliente_nome"
              :error-messages="
                v$.cliente.cliente_nome.$errors.map((e) => e.$message)
              "
              counter="255"
              label="Insira seu nome"
              @input="v$.cliente.cliente_nome.$touch"
              @blur="v$.cliente.cliente_nome.$touch"
            ></v-text-field>
            <v-text-field
              v-if="escolhamodalidade == 'dono'"
              v-model="dono.nome"
              :error-messages="v$.dono.nome.$errors.map((e) => e.$message)"
              counter="255"
              label="Insira seu nome"
              @input="v$.dono.nome.$touch"
              @blur="v$.dono.nome.$touch"
            >
            </v-text-field>
          </v-col>
          <v-col cols="6">
            <v-text-field
              :disabled="escolhamodalidade == 'cliente'"
              v-model="empresa.nome"
              :error-messages="v$.empresa.nome.$errors.map((e) => e.$message)"
              label="Insira o nome da sua empresa"
              @input="v$.empresa.nome.$touch"
              @blur="v$.empresa.nome.$touch"
              counter="255"
            ></v-text-field>
          </v-col>
        </v-row>
        <v-row>
          <v-col cols="6">
            <v-text-field
              v-if="escolhamodalidade == 'cliente'"
              v-model="cliente.cliente_email"
              type="email"
              :error-messages="
                v$.cliente.cliente_email.$errors.map((e) => e.$message)
              "
              label="Insira seu email"
              @input="v$.cliente.cliente_email.$touch"
              @blur="v$.cliente.cliente_email.$touch"
            ></v-text-field>
            <v-text-field
              v-if="escolhamodalidade == 'dono'"
              v-model="dono.email"
              type="email"
              :error-messages="v$.dono.email.$errors.map((e) => e.$message)"
              label="Insira seu email"
              @input="v$.dono.email.$touch"
              @blur="v$.dono.email.$touch"
            ></v-text-field>
          </v-col>
          <v-col cols="6">
            <v-text-field
              :disabled="escolhamodalidade == 'cliente'"
              v-model="empresa.cnpj"
              :error-messages="v$.empresa.cnpj.$errors.map((e) => e.$message)"
              label="Insira o CNPJ da sua empresa"
              @input="v$.empresa.cnpj.$touch"
              @blur="v$.empresa.cnpj.$touch"
              counter="14"
            ></v-text-field>
          </v-col>
        </v-row>
        <v-row>
          <v-col cols="6">
            <v-text-field
              :disabled="escolhamodalidade == 'dono'"
              v-model="cliente.cliente_cpf"
              :error-messages="
                v$.cliente.cliente_cpf.$errors.map((e) => e.$message)
              "
              label="Insira seu CPF"
              @input="v$.cliente.cliente_cpf.$touch"
              @blur="v$.cliente.cliente_cpf.$touch"
            ></v-text-field>
          </v-col>
          <v-col cols="6">
            <v-select
              :items="descricao"
              label="Como você define seu estabelecimento?"
              :disabled="escolhamodalidade == 'cliente'"
              v-model="empresa.descricao"
            ></v-select>
          </v-col>
        </v-row>
        <v-row>
          <v-col cols="6">
            <v-text-field
              v-if="escolhamodalidade == 'cliente'"
              type="password"
              label="Insira sua senha"
              v-model="cliente.cliente_senha"
              :error-messages="
                v$.cliente.cliente_senha.$errors.map((e) => e.$message)
              "
              @input="v$.cliente.cliente_senha.$touch"
              @blur="v$.cliente.cliente_senha.$touch"
            ></v-text-field>
            <v-text-field
              v-if="escolhamodalidade == 'cliente'"
              type="password"
              label="Confirme sua senha"
              v-model="cliente.cliente_senha_confirmacao"
              :error-messages="
                v$.cliente.cliente_senha_confirmacao.$errors.map(
                  (e) => e.$message
                )
              "
              @input="v$.cliente.cliente_senha_confirmacao.$touch"
              @blur="v$.cliente.cliente_senha_confirmacao.$touch"
            ></v-text-field>
            <v-text-field
              v-if="escolhamodalidade == 'dono'"
              type="password"
              label="Insira sua senha"
              v-model="dono.senha"
              :error-messages="v$.dono.senha.$errors.map((e) => e.$message)"
              @input="v$.dono.senha.$touch"
              @blur="v$.dono.senha.$touch"
            ></v-text-field>
            <v-text-field
              v-if="escolhamodalidade == 'dono'"
              type="password"
              label="Confirme sua senha"
              v-model="dono.senhaVerificacao"
              :error-messages="
                v$.dono.senhaVerificacao.$errors.map((e) => e.$message)
              "
              @input="v$.dono.senhaVerificacao.$touch"
              @blur="v$.dono.senhaVerificacao.$touch"
            ></v-text-field>
          </v-col>
          <v-col cols="6">
            <v-file-input
              accept="image/png, image/jpg, image/jpeg"
              prepend-icon="fas fa-paperclip"
              label="Caso tenha, insira o logo da sua empresa"
              :disabled="escolhamodalidade == 'cliente'"
              v-model="empresa.logo"
            ></v-file-input>
          </v-col>
        </v-row>

        <v-row>
          <v-col cols="6">
            <v-text-field
              :disabled="escolhamodalidade == 'dono'"
              label="Insira seu telefone pessoal"
              v-model="cliente.cliente_telefone_pessoal"
              :error-messages="
                v$.cliente.cliente_telefone_pessoal.$errors.map(
                  (e) => e.$message
                )
              "
              @input="v$.cliente.cliente_telefone_pessoal.$touch"
              @blur="v$.cliente.cliente_telefone_pessoal.$touch"
              counter="20"
            ></v-text-field>
          </v-col>
        </v-row>
        <v-row>
          <v-col cols="6">
            <v-text-field
              :disabled="escolhamodalidade == 'dono'"
              label="Insira seu telefone de contato"
              v-model="cliente.cliente_telefone_contato"
              :error-messages="
                v$.cliente.cliente_telefone_contato.$errors.map(
                  (e) => e.$message
                )
              "
              @input="v$.cliente.cliente_telefone_contato.$touch"
              @blur="v$.cliente.cliente_telefone_contato.$touch"
              counter="20"
            ></v-text-field>
          </v-col>
          <v-col cols="6">
            <v-btn block size="x-large" type="submit">Cadastro</v-btn>
          </v-col>
        </v-row>
      </form>
    </div>
  </main>
</template>

<style scoped>
main {
  height: 100vh;
}

.container-cadastro {
  display: flex;
  justify-content: center;
  align-items: center;
  height: 100%;
}
.form-cadastro {
  width: 60%;
  background-color: var(--platinum);
  padding: 2rem;
}
.escolha-modalidade {
  width: 50%;
  display: flex;
  justify-content: center;
  align-items: center;
  gap: 3rem;
  padding-bottom: 2rem;
}

.escolha-label {
  padding: 0.375rem;
  border-radius: 50px;
  display: inline-flex;
  cursor: pointer;
  transition: background 0.2s ease;
  margin: 0.5rem 0;
  -webkit-tap-highlight-color: transparent;
}

.escolha-label:hover,
.escolha-label:focus-within {
  background: rgba(159, 159, 159, 0.1);
}

.escolha-label input {
  vertical-align: middle;
  width: 20px;
  height: 20px;
  border-radius: 10px;
  background: none;
  border: 0;
  box-shadow: inset 0 0 0 1px #9f9f9f;
  box-shadow: inset 0 0 0 1.5px #9f9f9f;
  appearance: none;
  padding: 0;
  margin: 0;
  transition: box-shadow 150ms cubic-bezier(0.95, 0.15, 0.5, 1.25);
  pointer-events: none;
}

.escolha-label input:focus {
  outline: none;
}
.escolha-label input:checked {
  box-shadow: inset 0 0 0 6px #6743ee;
}
.escolha-label span {
  vertical-align: middle;
  display: inline-block;
  line-height: 20px;
  padding: 0 8px;
}
</style>
