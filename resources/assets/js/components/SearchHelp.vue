<style>
.search-help-container {
	position: relative;
}
.search-help {
	background: #fff;
	text-align: start;
	position: absolute;
	width: 100%;
}
.search-help li {
	margin: 0;
}
.search-help li a {
	padding: 10px 20px;
	display: block;
	border-bottom: 1px solid #ccc;
}
.search-help li:last-child a {
	border-bottom: 0;
}
.search-help li a:hover {
	text-decoration: none;
	background: #fafafa;
}
.search-help.no-result {
	padding: 5px 15px;
	font-style: italic;
}
</style>

<template>
	<div class="form-group form-group-lg search-help-container">
		<input type="text" class="form-control" placeholder="{{ placeholder }}" v-model="query" debounce="500">
		<div class="search-help no-result" v-if="noResults">{{ noHitsMsg }}</div>
		<ul class="search-help" v-for="result in results">
			<li><a href="/{{ locale }}/help/{{ result.id }}">{{ result.question }}</a></li>
		</ul>
	</div>
</template>

<script>
export default {
	props: {
		placeholder: {
			type: String,
			default: 'Search Help'
		},
		noHitsMsg: {
			type: String,
			default: 'No results found'
		}
	},

	data() {
		return {
			locale: location.pathname.split('/')[1],
			query: '',
			results: [],
			noResults: false
		}
	},

	watch: {
		query(value) {
			// Check if string is not only whitespaces and contains at least 3 chars before invoking xhr
			if( value.replace(/\s/g, '').length && value.replace(/\s/g, '').length >= 3 ) {
				this.search();
			} else {
				this.results = [];
				this.noResults = false;
			}
		}
	},

	methods: {
		search() {
			this.$http.get(`/${this.locale}/help/search/`, {q: this.query}).then(response => {
				this.results = response.data.hits;
				this.noResults = ! this.results.length;
		}, () => {
				console.log('err');
			});
		}
	}
}
</script>