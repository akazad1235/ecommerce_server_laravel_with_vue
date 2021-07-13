<template>
    <app-layout>
        <Models :data="data" :link="link" :label="label" :title="title" >
            <template #header>
                <Header
                    :title="title"
                    :flash="flash"
                    :errors="errors"
                    :link="link"
                    :label="label"
                />
            </template>
        </Models>
    </app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout'
import Models from './components/Models'
import Header from "@/Pages/Component/Header";


export default {
    components: {
        Models,
        AppLayout,
        Header
    },
    props: ['data', 'errors', 'flash'],
    data () {
        return {
            title: 'Create Mail Settings',
            link:'product.create',
            label: 'Settings'
        }
    }
}
</script>
