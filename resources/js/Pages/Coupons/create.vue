<template>
    <app-layout>
        <Model :data="data" :errors="errors" :createMode="1" :link="link" :label="label" :title="title" >
            <template #header>
                <Header
                    :title="title"
                    :flash="flash"
                    :errors="errors"
                    :link="link"
                    :label="label"
                />
            </template>
        </Model>
    </app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout';
import Model from './components/Model';
import Header from "@/Pages/Component/Header";


export default {
    components: {
        Model,
        AppLayout,
        Header
    },
    props: ['data', 'errors', 'flash'],
    data () {
        return {
            title: 'Create Brand',
            link:'brand.index',
            label: 'Create Brand'
        }
    }
}
</script>
