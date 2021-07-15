<template>
    <app-layout>
        <Products :data="data" :createMode="1" :errors="errors" :title="title" :link="link" :label="label">
            <template #header>
                <Header
                    :title="title"
                    :flash="flash"
                    :errors="errors"
                    :link="link"
                    :label="label"
                />
            </template>
        </Products>
    </app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout'
import Products from './components/Products'
import Header from '@/Pages/Component/Header'


export default {
    components: {
        Products,
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
