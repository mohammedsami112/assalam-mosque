<script setup>
const props = defineProps(['states']);
const statistics = [

  {
    title: 'Users',
    stats: '12.5k',
    icon: 'ri-group-line',
    color: 'success',
  },
  {
    title: 'Posts',
    stats: '1.54k',
    icon: 'ri-macbook-line',
    color: 'warning',
  },
  {
    title: 'Donations',
    stats: '$88k',
    icon: 'ri-money-dollar-circle-line',
    color: 'info',
  },
]
</script>

<template>
  <VCard title="Statistics">
    <VCardText class="pt-10">
      <VRow>
<!--        <VCol-->
<!--          v-for="item in statistics"-->
<!--          :key="item.title"-->
<!--          cols="12"-->
<!--          sm="6"-->
<!--          md="4"-->
<!--        >-->
<!--          <div class="d-flex align-center gap-x-3">-->
<!--            <VAvatar-->
<!--              :color="item.color"-->
<!--              rounded-->
<!--              size="40"-->
<!--              class="elevation-2"-->
<!--            >-->
<!--              <VIcon-->
<!--                size="24"-->
<!--                :icon="item.icon"-->
<!--              />-->
<!--            </VAvatar>-->

<!--            <div class="d-flex flex-column">-->
<!--              <div class="text-body-1">-->
<!--                {{ item.title }}-->
<!--              </div>-->
<!--              <h5 class="text-h5">-->
<!--                {{ item.stats }}-->
<!--              </h5>-->
<!--            </div>-->
<!--          </div>-->
<!--        </VCol>-->

        <VCol
          cols="12"
          sm="6"
          md="4"
          v-if='props.states.total_users >= 0'
        >
          <div class="d-flex align-center gap-x-3">
            <VAvatar
              color="success"
              rounded
              size="40"
              class="elevation-2"
            >
              <VIcon
                size="24"
                icon="ri-group-line"
              />
            </VAvatar>

            <div class="d-flex flex-column">
              <div class="text-body-1">
                Users
              </div>
              <h5 class="text-h5">
                {{ props.states.total_users }}
              </h5>
            </div>
          </div>
        </VCol>

        <VCol
          cols="12"
          sm="6"
          md="4"
          v-if='props.states.total_posts >= 0'
        >
          <div class="d-flex align-center gap-x-3">
            <VAvatar
              color="warning"
              rounded
              size="40"
              class="elevation-2"
            >
              <VIcon
                size="24"
                icon="ri-macbook-line"
              />
            </VAvatar>

            <div class="d-flex flex-column">
              <div class="text-body-1">
                Posts
              </div>
              <h5 class="text-h5">
                {{ props.states.total_posts }}
              </h5>
            </div>
          </div>
        </VCol>

        <VCol
          cols="12"
          sm="6"
          md="4"
          v-if='props.states.total_donations >= 0'
        >
          <div class="d-flex align-center gap-x-3">
            <VAvatar
              color="info"
              rounded
              size="40"
              class="elevation-2"
            >
              <VIcon
                size="24"
                icon="ri-money-dollar-circle-line"
              />
            </VAvatar>

            <div class="d-flex flex-column">
              <div class="text-body-1">
                Donations
              </div>
              <h5 class="text-h5">
                {{ props.states.total_donations }}
              </h5>
            </div>
          </div>
        </VCol>

      </VRow>
    </VCardText>
  </VCard>
</template>
