<script>
// @ is an alias to /src
import Multiselect from "vue-multiselect";
import configValues from "@/config/index";
import 'sweetalert2/dist/sweetalert2.min.css';

export default {
  name: 'HomeView',
  components: {
      Multiselect,
     
  },
    data() {
        return {
            specialty: null, 
            specialties_option: [],
            professionais_option: [],
            sources_option: [],
            show_loader: false,
            url: configValues.BACKEND_URL,
            token: configValues.TOKEN,
            scheduleModal: false,
            modalForm:{
                name: '',
                birthdate: '',
                cpf: '',
                source_id: '',
                professional_id: '',
                specialty_id: ''
            }

        }
    },

    created() {
        this.getSpecialties();    
    },
    methods: {
        // se a response vier com o campo success = true, então o request foi feito com sucesso
        // se o campo exibir_agendamento_online == 1, então vamos adicionar o campo no array de options
        getSpecialties() {
             this.show_loader = true;
            this.$http.get(this.url +'specialties/index')
            .then(response => {
                if (response.data.success) {
                 
                    this.specialties_option = response.data.content.map(function(item) {
                        if (item.exibir_agendamento_online == 1) {
                            return {
                                id: item.especialidade_id,
                                name: item.nome
                            }
                        }

                    });
                }
            })
            .finally(() => {
                this.show_loader = false;
            })

            
        },
        // retorna profissionais que atendem a especialidade selecionada
        getProfessionais () {
       
            if (this.specialty.id != null) {
                this.show_loader = true;
                this.$http.get(this.url +'professionals/index/' + this.specialty.id)
                .then(response => { 
                    this.professionais_option = response.data.map(function(item) {
                        return {
                            id: item.profissional_id,
                            name: item.nome,
                            doc_type: item.conselho,
                            doc: item.documento_conselho,
                            doc_uf: item.uf_conselho,
                            photo_url: item.foto,
                            gender: item.sexo
                        }
                    });
                })
                .finally(() => {
                    this.show_loader = false;
                })
            }
            
        },
         // retorna profissionais que atendem a especialidade selecionada
        getSources() {
       
            if (this.specialty.id != null) {
                this.show_loader = true;
                this.$http.get(this.url +'sources/index' )
                .then(response => { 
                    this.sources_option = response.data.content.map(function(item) {
                        return {
                            id: item.origem_id,
                            name: item.nome_origem
                        }
                    });
                })
                .finally(() => {
                    this.show_loader = false;
                })
            }
            
        },
        schedule(professional_id){
            this.scheduleModal = true;
            this.modalForm.professional_id = professional_id;
            this.getSources();

        },
        submitModal(){

            if (this.modalForm.name == "" || this.modalForm.birthdate == "" || this.modalForm.cpf == "" || this.modalForm.source_id == "") {
                this.$swal({
                    type: 'error',
                    title: 'Oops...',
                    text: 'Preencha todos os campos para continuar!', 
                })
            }else{


                this.show_loader = true;
                let formData = {
                    name: this.modalForm.name,
                    birthdate: this.modalForm.birthdate,
                    cpf: this.modalForm.cpf,
                    source_id: this.modalForm.source_id.id,
                    professional_id: this.modalForm.professional_id,
                    specialty_id: this.specialty.id
                }


                this.$http.post(this.url +'schedules/store', formData)
                .then(response => { 
                    console.log(response);
                    // limpa o formulário
                        this.modalForm = {
                            name: '',
                            birthdate: '',
                            cpf: '',
                            source_id: '',
                            professional_id: '',
                            specialty_id: ''
                        }
                    // fecha modal
                    this.scheduleModal = false;

                    // mostra mensagem de sucesso
                    this.$swal({
                        type: 'success',
                        title: 'Agendamento realizado com sucesso!',
                        showConfirmButton: false,
                        timer: 1500
                    })
                })
                .finally(() => {
                    this.show_loader = false;
                })  

            }
        

        },
        closeModal(){
            this.scheduleModal = false;
        },
    },
}
</script>

 

<template>
  <div class="home">

        <div v-show="show_loader">
            <loader object="#ff9633" color1="#ffffff" color2="#17fd3d" size="5" speed="2" bg="#343a40" objectbg="#999793" opacity="80" name="circular"></loader>
        </div>

        <h2 class="texte-center">Clínica </h2>
        <h3 class="text-center">Agendamento Online</h3>

        <div>
            <b-container class="">
        
                <b-row class="text-center">
                
                   <b-col cols="12" class="specialties">
                    
                        <div class="mb-3">
                            <label class="form-label" for="dentists"> Consulta de:  </label>
                            <multiselect id="dentists" 
                                v-model="specialty"  
                                placeholder="Selecione" 
                                track-by="id" 
                                label="name" 
                                @input="getProfessionais"  
                                :options="specialties_option" 
                                :show-labels="true" 
                                :close-on-select="true"></multiselect>
                        </div>
                    </b-col>
                  
                </b-row>   
                 
                          
                <h3 v-if="this.professionais_option.length  > 0">
                    {{ this.professionais_option.length }} Profissionais da área:  {{ this.specialty.name }} encontrados
                </h3>


                <b-row class="professionais">
                    <b-col cols="3" v-for="professional in this.professionais_option" :key="professional.id">
 
                            <b-card  
                                img-alt="Image"
                                img-top
                                tag="article"
                                style="max-width: 20rem;"
                                class="mb-2"  >   

                                <p v-if="professional.photo_url != null ">
                                     <b-img thumbnail fluid rounded="circle" :src="professional.photo_url"  class="img"></b-img>  
                                </p>
                                <p v-else>
                                      <b-img thumbnail fluid rounded="circle" :src="require('@/assets/load-image.png')"  class="img"></b-img>  
                                </p>
                                <b-card-text>
                                    <p class="name">
                                        <b>Nome:</b> {{ professional.name }}
                                        <br/>
                                        <span class="doc" v-show="professional.doc != '' "><b > {{ professional.doc_type }}:</b> {{ professional.doc }}/{{ professional.doc_uf }}</span>
                                    </p>  
                                </b-card-text>

                                <b-button href="#" variant="success" @click.prevent="schedule(professional.id)">Agendar</b-button>
                            </b-card>
                          


                    </b-col>
                    
                </b-row>
            </b-container>
            
   
        </div>

            <!-- Modal -->
            <b-modal  centered  v-model="scheduleModal" size="lg"  title-class="text-black font-18"  hide-footer  body-class="p-4"  >
                <div slot="modal-title">
                    Preencha seus Dados
                </div>
                <form @submit.prevent="submitModal">
                    <div class="row mt-2">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Nome Completo</label>
                                <input type="text" class="form-control" id="name" v-model="modalForm.name" required>
                            </div>

                            <div class="form-group">
                                <label for="name">Como Conheceu?</label>
                                <multiselect id="dentists" 
                                    v-model="modalForm.source_id"  
                                    placeholder="Selecione" 
                                    track-by="id" 
                                    label="name" 
                                    :options="sources_option" 
                                    :show-labels="true" 
                                    :close-on-select="true"></multiselect>
                             
                            </div>
                        </div>
                
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Nascimento</label>
                                <input type="date" class="form-control" id="name" v-model="modalForm.birthdate" required>
                            </div>

                            <div class="form-group">
                                <label for="name">CPF</label>
                                <the-mask :mask="['###.###.###-##']" class="form-control" v-model="modalForm.cpf"  />

                            </div>
                        </div>
                    </div>


                    <div class="row mt-2">
                        <div class="col-12 text-end">
                            <b-button variant="light" @click="closeModal">Cancelar</b-button>
                            <b-button class="ms-1" variant="success" @click="submitModal">Agendar</b-button>
                        </div>
                    </div>
                </form>
            </b-modal>


  </div>





</template>

<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>

<style scoped>
    h3{
        margin-top:10px;
    }
    .specialties{
        background-color: #4c9bd8;
        padding: 20px;
        border-radius: 10px;
    }
    .professionais .card {
        margin-top:25px;
        min-height: 220px;
    }
    .professionais .card p {
        font-size: 12px;
    }
    .img{
        min-height: 100px;
        max-height: 100px;
        max-width: 100px;
    }
    
</style>

