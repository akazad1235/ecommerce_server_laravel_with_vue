<template>
    <app-layout>
        <Models :data="data" :createMode="1" :link="link" >

        </Models>
    </app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout'
import Models from './components/Models'

export default {
    components: {
        Models,
        AppLayout,


    },
    props: ['data', 'errors', 'flash'],
    data () {
        return {
            title: 'Create Mail Settings',
            link:'categories.create',
            label: 'Settings'
        }
    }
}
</script>
