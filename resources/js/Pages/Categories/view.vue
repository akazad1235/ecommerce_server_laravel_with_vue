<template>
    <app-layout>
        <Model :data="data" :viewMode="1" :link="link" :title="title" :label="label">

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
            title: 'View Category',
            link:'categories.index',
            label: 'View'
        }
    }
}
</script>
