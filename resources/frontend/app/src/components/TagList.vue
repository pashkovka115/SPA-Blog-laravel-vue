<template>
    <nav class="blog-pagination" aria-label="Pagination" v-if="tags && tags.length > 0">
        <router-link
            :to="{name: 'tag', params:{slug: tag.slug}}"
            class="btn btn-outline-primary"
            v-for="tag in tags"
            :key="tag.id"
        >
            {{ tag.name }}
        </router-link>
    </nav>
</template>

<script>
export default {
    name: "McvTagList",
    props:{
        tags: {
            type: Array,
            required: false,
            default: false
        }
    }
}
</script>

<style scoped>

</style>
