<template>
    <app-layout>
        <Azad  >

        </Azad>
    </app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout'
import Azad from './components/Azad'


export default {
    components: {
        AppLayout,
        Azad,

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
