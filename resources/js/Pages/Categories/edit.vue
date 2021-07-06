<template>
    <app-layout>
        <Model :data="data" :editMode="1" :link="link" :title="title" :label="label">

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
            title: 'Update categories',
            link:'categories.index',
            label: 'Update categories'
        }
    }
}
</script>
