<template>
    <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-center">
            <li v-if="links" class="page-item" :class="{disabled: !links.prev}">
                <router-link v-if="links.prev" :to="links.prev" class="page-link">Previous</router-link>
                <a v-else class="page-link" :href="links.prev">Previous</a>
            </li>
            <li class="page-item" v-if="meta" v-for="(link, index) in meta.links" :key="index" :class="{active: link.active}">
                <router-link
                    :to="'?page=' + link.label"
                    v-if="link.url && ($filters.is_numeric(link.label))"
                    class="page-link"
                    @click="getFeed(link.label)"
                >
                    {{ link.label }}
                </router-link>
                <a class="page-link" v-else-if="link.label === '...'" :href="link.url">{{ link.label }}</a>
            </li>
            <li v-if="links" class="page-item" :class="{disabled: !links.next}">
                <router-link v-if="links.next" :to="links.next" class="page-link">Next</router-link>
                <a v-else class="page-link" :href="links.next">Next</a>
            </li>
        </ul>
    </nav>
</template>

<script>
import {actionTypes} from "@/store/modules/feed";
import {paramForNav} from "@/helpers/vars";

export default {
    name: "McvPagination",
    props:{
        links:{
            type: Object,
            required: false
        },
        meta:{
            type: Object,
            required: false
        },
        // Добавить в строку запроса URL для реального запроса на сервер
        apiUrl: {
            type: String,
            required: false,
            default: ''
        }
    },
    methods:{
        getFeed(page){
            this.$store.dispatch(
                actionTypes.getFeed,
                {apiUrl: this.apiUrl + '?' + paramForNav + '=' + page}
            )
        }
    },
}
</script>
