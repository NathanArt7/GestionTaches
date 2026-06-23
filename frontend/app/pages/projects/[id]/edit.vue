<template>
  <div>
    <h1>Modifier un projet</h1>

    <form @submit.prevent="updateProject">
      <div>
        <label>Titre</label><br>
        <input v-model="form.titre" type="text">
      </div>

      <br>

      <div>
        <label>Description</label><br>
        <textarea v-model="form.description"></textarea>
      </div>

      <br>

      <div>
        <label>Date début</label><br>
        <input v-model="form.date_debut" type="date">
      </div>

      <br>

      <div>
        <label>Date fin</label><br>
        <input v-model="form.date_fin" type="date">
      </div>

      <br>

      <button type="submit">
        Enregistrer
      </button>
    </form>
  </div>
</template>

<script setup>
const route = useRoute()

const { data: project } = await useFetch(
  `http://127.0.0.1:8000/api/projects/${route.params.id}`
)

const form = ref({
  user_id: project.value.user_id,
  titre: project.value.titre,
  description: project.value.description,
  date_debut: project.value.date_debut,
  date_fin: project.value.date_fin
})

const updateProject = async () => {
  await $fetch(
    `http://127.0.0.1:8000/api/projects/${route.params.id}`,
    {
      method: 'PUT',
      body: form.value
    }
  )

  navigateTo('/project')
}
</script>