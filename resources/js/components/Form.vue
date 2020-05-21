<template>
    <div class="card-body">
        <form method="POST" class="form floating-label" @submit.prevent="model.id? update() : store()" @input="model.errors.clear($event.target.id)">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="name" class="control-label">Nombre del Jugador</label>
                        <input type="text" id="name" class="form-control input-lg" :class="{'is-invalid': model.errors.has('name')}" v-model="model.name">
                        <span class="invalid-feedback" v-if="model.errors.has('name')" v-text="model.errors.get('name')"></span>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="position" class="control-label">Posición</label>
                        <input type="text" id="position" class="form-control input-lg" :class="{'is-invalid': model.errors.has('position')}" v-model="model.position">
                        <span class="invalid-feedback" v-if="model.errors.has('position')" v-text="model.errors.get('position')"></span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="goals" class="control-label">Goles</label>
                        <input type="text" id="goals" class="form-control input-lg" :class="{'is-invalid': model.errors.has('goals')}" v-model="model.goals">
                        <span class="invalid-feedback" v-if="model.errors.has('goals')" v-text="model.errors.get('goals')"></span>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <a @click="close()" class="btn btn-flat" href="javascript:void(0);">Cancelar</a>
                    <button type="submit" class="btn btn-flat btn-primary" :disabled="model.inProgress">Guardar</button>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
    import Form from '../helpers/Form'
    import Errors from '../helpers/Errors'

    export default {
        data () {
            return {
                model: new Form({
                    name: '',
                    position: '',
                    goals: 0
                }),
                errors: new Errors()
            }
        },
        props: {
            apiUrl: ''
        },
        created () {
            EventBus.$on('formLoad', this.onFormLoad)
            EventBus.$on('formReset', e => this.onFormReset())
        },
        methods: {
            close () {
                EventBus.$emit('formToggle')
            },
            store () {
                this.model.post(this.apiUrl)
                    .then(this.success)
                    .catch(this.fail)
            },
            update () {
                this.model.patch(this.apiUrl + '/' + this.model.id)
                    .then(this.success)
                    .catch(this.fail)
            },
            success (response) {
                EventBus.$emit('filterReset')
                EventBus.$emit('formToggle')
                EventBus.$emit('alertAction', 'success')
            },
            fail (error) {
                EventBus.$emit('alertAction', 'error')
            },
            resetFields () {
                this.model.state = true
            },
            onFormLoad (data) {
                this.model.load(data)

                EventBus.$emit('editionEnable')
                EventBus.$emit('formToggle')
            },
            onFormReset () {
                this.model.reset()
                this.resetFields()
            }
        }
    }
</script>
