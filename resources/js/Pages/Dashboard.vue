<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head} from '@inertiajs/vue3';</script>

<template>
    <Head title="Dashboard"/>

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Главная</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="site_flex">
                    <div class="site_filter bg-white rounded-md shadow-lg p-3">
                        <div class="title">Фильтр</div>
                        <div>
                            <input type="checkbox" id="free" name="free" v-model="free_filter">
                            <label for="free">Бесплатно</label><br>
                            <input type="checkbox" id="paid" name="paid" v-model="paid_filter">
                            <label for="paid">Платно</label><br>
                            <input type="checkbox" id="android" name="android" v-model="android_filter">
                            <label for="android">Android</label><br>
                            <input type="checkbox" id="ios" name="ios" v-model="ios_filter">
                            <label for="ios">iOS</label><br>
                        </div>

                        <button @click="search">Найти</button>
                    </div>

                    <div class="site_objects bg-white rounded-md shadow-lg p-3 max-w-7xl">
                        <div class="title">Объекты</div>
                        <div>
                            <div v-for="(item, index) in result" :key="index">
                                {{ item.title }} {{ getCategory(item.categories) }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script>
export default {
    props: ['categories', 'objects'],

    data() {
        return {
            free_filter: false,
            paid_filter: false,
            android_filter: false,
            ios_filter: false,

            free_vop: '0',
            paid_vop: '0',
            android_vop: '0',
            ios_vop: '0',

            result: this.objects,
        }
    },

    methods: {
        getCategory(id) {
            let idArr = id.split('|')
            let cats = ['Платные', 'Бесплатные', 'Android', 'iOS']
            let result = []
            for (let i = 0; i < idArr.length; i++) {
                result.push(cats[idArr[i] - 1])
            }
            let string = JSON.stringify(result);
            string.replace(/"/g,'');
            string.replace(/["']/g, "");
            return string
        },

        search() {
            this.free_vop = (this.free_filter === false) ? this.free_vop = '0' : this.free_vop = '1'
            this.paid_vop = (this.paid_filter === false) ? this.paid_vop = '0' : this.paid_vop = '1'
            this.android_vop = (this.android_filter === false) ? this.android_vop = '0' : this.android_vop = '1'
            this.ios_vop = (this.ios_filter === false) ? this.ios_vop = '0' : this.ios_vop = '1'

            const result = Object.values(this.objects).filter(value => {
                if ((value.free === this.free_vop) && (value.paid === this.paid_vop)&& (value.android === this.android_vop)&& (value.ios === this.ios_vop)) {
                    return value
                }
            });

            this.result = result
        }
    },
}
</script>


<style lang="sass" scoped>
.site
    &_flex
        display: flex
        justify-content: space-between
        gap: 30px

        .title
            font-size: 20px
            padding-bottom: 5px
            border-bottom: 2px solid #d9d9d9
            margin-bottom: 10px

    &_filter
        flex: 0 0 257px

        input[type=checkbox]
            margin-right: 10px

    &_objects
        width: 100%
</style>
