<template>
    <app-layout>
        <Model  >

        </Model>
    </app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout'
import Model from './components/Model'


export default {
    components: {
        AppLayout,
        Model,

    },
    props: ['data', 'errors', 'flash'],
    data () {
        return {
            title: 'Create Mail Settings',

            label: 'Settings'
        }
    }
}
</script>
