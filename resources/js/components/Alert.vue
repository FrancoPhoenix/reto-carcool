<template>
    <div class="modal fade" id="simpleAlert" tabindex="-1" role="dialog" aria-labelledby="simpleAlertLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="simpleModalLabel" v-text="mainTitle"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <p v-text="mainContent"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark" data-dismiss="modal" v-text="acceptText"></button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data () {
            return {
                model: '',
                inProgress: false
            }
        },
        props: {
            mainTitle: {
                type: String,
                default: ''
            },
            mainContent: {
                type: String,
                default: ''
            },
            acceptText: {
                type: String,
                default: 'Aceptar'
            },
            actionColor: {
                type: String,
                default: 'btn-success'
            }
        },
        mounted () {
            EventBus.$on('beforeModalAction', this.onLoadModel)
        },
        methods: {
            action () {
                EventBus.$emit('alertAction', this)
            },
            onLoadModel (data) {
                this.model = data
            }
        }
    }
</script>
