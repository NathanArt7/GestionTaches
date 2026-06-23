<template>
  <div>
    <h1>Nouveau Projet</h1>

    <form @submit.prevent="createProject">
      <div>
        <label>Titre</label><br>
        <input v-model="form.titre" type="text" />
      </div>

      <br>

      <div>
        <label>Description</label><br>
        <textarea v-model="form.description"></textarea>
      </div>

      <br>

      <div>
        <label>Date début</label><br>
        <input v-model="form.date_debut" type="date" />
      </div>

      <br>

      <div>
        <label>Date fin</label><br>
        <input v-model="form.date_fin" type="date" />
      </div>

      <br>

      <button type="submit">Créer</button>
    </form>
  </div>
</template>

<script setup>
const form = ref({
  user_id: 1,
  titre: '',
  description: '',
  date_debut: '',
  date_fin: ''
})

const createProject = async () => {
  try {
    await $fetch('http://127.0.0.1:8000/api/projects', {
      method: 'POST',
      body: form.value
    })

    navigateTo('/project')

  } catch (error) {
    console.log(error.data)
  }
}
</script>