<template>
    <app-layout>
        <Categories :data="data" :createMode="1" :errors="errors" :title="title" :link="link" :label="label">
            <template #header>
                <Header
                    :title="title"
                    :flash="flash"
                    :errors="errors"
                    :link="link"
                    :label="label"
                />
            </template>
        </Categories>
    </app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout'
import Categories from './components/Categories'
import Header from '@/Pages/Component/Header'


export default {
    components: {
        Categories,
        AppLayout,
        Header
    },
    props: ['data', 'errors', 'flash'],
    data () {
        return {
            title: 'Generate Report',
            link: 'categories.generate',
            label: 'Report'
        }
    }
}
</script>
