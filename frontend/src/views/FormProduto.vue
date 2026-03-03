<template>
  <div class="bg-light">
    <HeaderPrincipal />

    <main class="form-wrapper">
      <div class="mdl-card mdl-shadow--4dp form-card">
        <div v-if="carregando" class="loading-overlay">
          <div
            class="mdl-progress mdl-js-progress mdl-progress__indeterminate"
          ></div>
          <p>Salvando produto...</p>
        </div>

        <div class="form-header">
          <h2 class="form-title">
            {{ id ? "Editar Produto" : "Novo Produto" }}
          </h2>
          <p class="form-subtitle">
            Cadastre as informações básicas e a foto principal do item.
          </p>
        </div>

        <form
          @submit.prevent="salvarProduto"
          class="mdl-grid main-form"
          :class="{ 'is-loading': carregando }"
        >
          <div
            class="mdl-cell mdl-cell--7-col mdl-cell--8-col-tablet mdl-grid no-padding"
          >
            <div class="mdl-cell mdl-cell--12-col field-box">
              <label for="nome">Título do produto</label>
              <input
                v-model="produto.nome"
                type="text"
                id="nome"
                placeholder="Ex: Tênis Casual Kappa"
                required
              />
            </div>

            <div class="mdl-cell mdl-cell--12-col field-box">
              <label for="desc">Descrição detalhada</label>
              <textarea
                v-model="produto.descricao"
                id="desc"
                rows="5"
                placeholder="Conte mais sobre o produto..."
                required
              ></textarea>
            </div>

            <div class="mdl-cell mdl-cell--6-col field-box">
              <label for="preco">Preço de venda</label>
              <div class="price-input-wrapper">
                <span class="currency">R$</span>
                <input
                  v-model="produto.preco"
                  type="number"
                  step="0.01"
                  id="preco"
                  placeholder="0,00"
                  required
                />
              </div>
            </div>
          </div>

          <div
            class="mdl-cell mdl-cell--5-col mdl-cell--8-col-tablet side-upload"
          >
            <div
              class="image-container"
              :class="{ 'has-img': previewImage || produto.imagem }"
            >
              <img
                v-if="previewImage || (id && produto.imagem)"
                :src="previewImage || getUrl(produto.imagem)"
                class="img-preview"
              />
              <div v-else class="img-placeholder">
                <i class="material-icons">add_a_photo</i>
                <span>Foto do Produto</span>
              </div>
            </div>

            <label class="btn-upload-label">
              <i class="material-icons">cloud_upload</i> {{ imageLabel }}
              <input
                type="file"
                @change="onFileChange"
                accept="image/*"
                hidden
              />
            </label>
          </div>

          <div class="mdl-cell mdl-cell--12-col actions-footer">
            <button type="button" @click="$router.push('/')" class="btn-link">
              Cancelar
            </button>
            <button
              type="submit"
              class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored btn-submit"
            >
              {{ id ? "Atualizar Produto" : "Publicar Produto" }}
            </button>
          </div>
        </form>
      </div>
    </main>
  </div>
</template>

<style scoped>
/* Estrutura Principal */
.bg-light {
  background: #f5f5f5;
  min-height: 100vh;
  padding-bottom: 40px;
}
.form-wrapper {
  max-width: 960px;
  margin: 40px auto;
  padding: 0 20px;
}
.form-card {
  width: 100%;
  border-radius: 8px;
  background: #fff;
  position: relative;
  overflow: hidden;
}

/* Cabeçalho do Form */
.form-header {
  padding: 30px 40px 10px;
  border-bottom: 1px solid #eee;
}
.form-title {
  font-size: 26px;
  font-weight: 600;
  color: #333;
  margin: 0;
}
.form-subtitle {
  color: #888;
  margin: 5px 0 0;
  font-size: 14px;
}

/* Estilização dos Inputs (Correção de Cor e Layout) */
.main-form {
  padding: 30px 40px;
}
.field-box {
  display: flex;
  flex-direction: column;
  margin-bottom: 15px;
}
.field-box label {
  font-size: 14px;
  font-weight: 600;
  color: #444;
  margin-bottom: 8px;
}

.field-box input,
.field-box textarea {
  background: #fff;
  border: 1px solid #ddd;
  border-radius: 4px;
  padding: 12px 15px;
  font-size: 15px;
  color: #333;
  transition: border 0.3s;
}
.field-box input:focus,
.field-box textarea:focus {
  border-color: #3483fa;
  outline: none;
  box-shadow: 0 0 0 2px rgba(52, 131, 250, 0.1);
}

/* Input de Preço Especial */
.price-input-wrapper {
  display: flex;
  align-items: center;
  background: #fff;
  border: 1px solid #ddd;
  border-radius: 4px;
  padding-left: 15px;
}
.price-input-wrapper input {
  border: none !important;
  flex: 1;
  padding-left: 5px;
}
.currency {
  font-weight: bold;
  color: #333;
}

/* Upload de Imagem Lado Direito */
.side-upload {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: flex-start;
  padding-top: 10px;
}
.image-container {
  width: 100%;
  height: 280px;
  background: #f9f9f9;
  border: 2px dashed #ccc;
  border-radius: 8px;
  display: flex;
  align-items: center;
  justify-content: center;
  margin-bottom: 15px;
  overflow: hidden;
}
.image-container.has-img {
  border-style: solid;
  border-color: #3483fa;
}
.img-preview {
  width: 100%;
  height: 100%;
  object-fit: contain;
}
.img-placeholder {
  text-align: center;
  color: #bbb;
}
.img-placeholder i {
  font-size: 48px;
  display: block;
}

.btn-upload-label {
  background: #e3edfb;
  color: #3483fa;
  padding: 10px 20px;
  border-radius: 4px;
  cursor: pointer;
  font-weight: 600;
  width: 100%;
  text-align: center;
  transition: 0.3s;
}
.btn-upload-label:hover {
  background: #d1e2f9;
}

/* Rodapé de Ações */
.actions-footer {
  border-top: 1px solid #eee;
  margin-top: 30px;
  padding-top: 25px;
  display: flex;
  justify-content: flex-end;
  gap: 20px;
  align-items: center;
}
.btn-link {
  background: none;
  border: none;
  color: #666;
  cursor: pointer;
  font-size: 15px;
}
.btn-submit {
  background: #3483fa !important;
  height: 45px;
  padding: 0 30px !important;
  font-weight: bold !important;
}

/* Loading State */
.loading-overlay {
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: rgba(255, 255, 255, 0.8);
  z-index: 100;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
}
.is-loading {
  filter: blur(2px);
  pointer-events: none;
}
</style>
<script>
import api from "../services/api";
import HeaderPrincipal from "../components/HeaderPrincipal.vue";

export default {
  name: "FormProduto",
  components: { HeaderPrincipal },
  data() {
    return {
      // Captura o ID da URL se existir (ex: /edit/6)
      id: this.$route.params.id || null,
      carregando: false,
      imageLabel: "Selecionar Foto",
      previewImage: null,
      produto: {
        nome: "",
        descricao: "",
        preco: "",
        imagem: null,
      },
    };
  },
  mounted() {
    // Se existir ID, o componente entra em modo de edição e busca os dados
    if (this.id) {
      this.buscarProduto();
    }
  },
  methods: {
    // Busca os dados do produto no Laravel
    async buscarProduto() {
      this.carregando = true;
      try {
        const response = await api.get(`/produtos/${this.id}`);
        this.produto = response.data;
        this.imageLabel = "Alterar Foto";
      } catch (error) {
        console.error("Erro ao carregar produto:", error);
        alert("Produto não encontrado.");
        this.$router.push("/");
      } finally {
        this.carregando = false;
      }
    },

    // Gera a URL da imagem vinda do storage do Laravel
    getUrl(img) {
      if (!img) return "";
      // Se for uma string (URL do banco), monta o caminho do storage
      return `http://localhost:8000/storage/${img}`;
    },

    // Gerencia a troca de imagem e o preview local
    onFileChange(e) {
      const file = e.target.files[0];
      if (file) {
        this.produto.imagem = file;
        this.imageLabel = file.name;
        this.previewImage = URL.createObjectURL(file);
      }
    },

    // Envia os dados para o Backend
    async salvarProduto() {
      this.carregando = true;

      const formData = new FormData();
      formData.append("nome", this.produto.nome);
      formData.append("descricao", this.produto.descricao);
      formData.append("preco", this.produto.preco);

      // Só envia a imagem se ela for um novo arquivo selecionado
      if (this.produto.imagem instanceof File) {
        formData.append("imagem", this.produto.imagem);
      }

      try {
        if (this.id) {
          // IMPORTANTE: Method Spoofing para o Laravel aceitar multipart em PUT
          formData.append("_method", "PUT");
          await api.post(`/produtos/${this.id}`, formData);
        } else {
          await api.post("/produtos", formData);
        }

        this.$router.push("/");
      } catch (error) {
        console.error("Erro ao salvar:", error);
        alert("Ocorreu um erro ao salvar o produto.");
      } finally {
        this.carregando = false;
      }
    },
  },
};
</script>
