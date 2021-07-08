<template>

    <div>
        <div v-if="flash.message" :type="flash.message?success(flash.message):''"></div>
<!--        <div v-if="flash.message " :type="flash.message | success"></div>-->
        <div v-if="flash.error" :type="flash.error?error(flash.error):''"></div>
<!--        <div v-if="Object.keys(errors).length" :type="error(errors)"></div>-->
        <p  v-if="flash.message">this si alwert box{{flash.error}}</p>
    </div>


</template>

<script>
import JetResponsiveNavLink from '@/Jetstream/ResponsiveNavLink'
import swal from 'sweetalert2'

window.Swal = swal
export default {
    components: {
        JetResponsiveNavLink
    },
    props: ['errors', 'title', 'flash', 'link', 'label'],
   filters: {
        // success (status) {
        //     const Toast = Swal.mixin({
        //         toast: true,
        //         position: 'top-end',
        //         showConfirmButton: false,
        //         timer: 3000,
        //         timerProgressBar: true,
        //         didOpen: toast => {
        //             toast.addEventListener('mouseenter', Swal.stopTimer)
        //             toast.addEventListener('mouseleave', Swal.resumeTimer)
        //         }
        //     })
        //
        //     Toast.fire({
        //         icon: 'success',
        //         title: status
        //     })
        // },
        // error (errors) {
        //     const Toast = Swal.mixin({
        //         toast: true,
        //         position: 'top-end',
        //         showConfirmButton: false,
        //         timer: 3000,
        //         timerProgressBar: true,
        //         didOpen: toast => {
        //             toast.addEventListener('mouseenter', Swal.stopTimer)
        //             toast.addEventListener('mouseleave', Swal.resumeTimer)
        //         }
        //     })
        //
        //     Toast.fire({
        //         icon: 'error',
        //         title: "There is some errors"
        //     })
        // }
    },
    methods:{
        success (status) {
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: toast => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            })

            Toast.fire({
                icon: 'success',
                title: status
            })
        },
        error (status) {
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: toast => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            })

            Toast.fire({
                icon: 'error',
                title: status
            })
        }
    }
}
</script>
