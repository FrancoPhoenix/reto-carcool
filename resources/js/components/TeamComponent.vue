<template>
    <div id="teamModule">
        <div class="card-header d-flex justify-content-between">
            <header v-text="titleGet()"></header>
            <transition name="fade">
                <div v-show="!showForm && !isEdit">
                    <button @click="formToggle()" class="btn btn-primary btn-sm">Agregar Jugador</button>
                </div>
            </transition>
        </div>

        <transition-group name="fade" mode="out-in">
            <div class="v-cloak--hidden" v-show="showForm" key="1">
                <player-form
                    :api-url="apiUrl"
                    :error-message="errorSubmitMessage"
                ></player-form>
            </div>

            <div class="card-body" v-show="!showForm" key="2">
                <vuetable ref="vuetable"
                          :api-url="apiUrl"
                          :fields="fields"
                          data-path=""
                          pagination-path=""
                >
                    <div slot="actions" slot-scope="props">
                        <button type="button" class="btn btn-icon-toggle" @click="itemAction('edit-item', props.rowData)"><i class="fas fa-edit"></i></button>
                        <button type="button" class="btn btn-icon-toggle" @click="itemAction('delete-item', props.rowData)"><i class="fas fa-trash"></i></button>
                    </div>
                </vuetable>
            </div>

        </transition-group>

        <alert
            :main-title="alertTitleGet()"
            :main-content="alertContentGet()"
        ></alert>
    </div>
</template>

<script>
    import PlayerForm from './Form'
    import Vuetable from 'vuetable-2'
    import Alert from './Alert'

    export default {
        data () {
            return {
                showForm: false,
                isEdit: false,
                actionAlert: 'success',
                fields: [
                    {
                        name: 'name',
                        sortField: 'name',
                        title: 'Nombre'
                    },
                    {
                        name: 'position',
                        sortField: 'position',
                        title: 'Posición'
                    },
                    {
                        name: 'goals',
                        sortField: 'goals',
                        title: 'Goles'
                    },
                    {
                        name: 'actions',
                        title: 'Acciones',
                        titleClass: 'center aligned',
                        dataClass: 'center aligned'
                    }
                ],
                css: {
                    ascendingIcon: 'glyphicon glyphicon-chevron-up',
                    descendingIcon: 'glyphicon glyphicon-chevron-down'
                },
                moreParams: {}
            }
        },
        components: {
            Vuetable, PlayerForm, Alert
        },
        props: {
            apiUrl: {
                type: String,
                default: ''
            },
            listTableTitle: {
                type: String,
                default: 'Lista de Jugadores'
            },
            newFormTitle: {
                type: String,
                default: 'Nuevo Jugador'
            },
            updateFormTitle: {
                type: String,
                default: 'Editar Jugador'
            },
            errorSubmitTitle: {
                type: String,
                default: 'Error'
            },
            errorSubmitMessage: {
                type: String,
                default: 'No se logró guardar correctamente.'
            },
            successSubmitTitle: {
                type: String,
                default: '¡Exito!'
            },
            successSubmitMessage: {
                type: String,
                default: 'Se logró guardar correctamente.'
            },
        },
        methods: {
            formToggle () {
                if (this.showForm){
                    this.isEdit = !this.showForm

                    EventBus.$emit('formReset')
                }

                EventBus.$emit('photoReset')

                this.showForm = !this.showForm
            },
            titleGet () {
                if (this.isEdit)
                    return this.updateFormTitle

                if (this.showForm)
                    return this.newFormTitle

                return this.listTableTitle
            },
            alertTitleGet () {
                if (this.actionAlert == 'success') {
                    return this.successSubmitTitle
                }

                if (this.actionAlert == 'error') {
                    return this.errorSubmitTitle
                }
            },
            alertContentGet () {
                if (this.actionAlert == 'success') {
                    return this.successSubmitMessage
                }

                if (this.actionAlert == 'error') {
                    return this.errorSubmitMessage
                }
            },
            onEditionEnable () {
                this.isEdit = true
            },
            onAlertAction (action) {
                console.log(action);
                if (action) {
                    this.actionAlert = action

                    $('#simpleAlert').modal('toggle')
                }
            },
            itemAction(action, data) {
                console.log("slot actions: on-click", data.name);
                if (action == 'edit-item') {
                    EventBus.$emit('formLoad', data)
                }

            }
        },
        created() {
            EventBus.$on('editionEnable', e => this.onEditionEnable())
            EventBus.$on('formToggle', e => this.formToggle())
            EventBus.$on('alertAction', this.onAlertAction)
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
