<?php
_echo( '###[group] 🔧 Setup Repository Title' );


if ( ! is_env_not_exists( get_env( 'GITHUB_REPOSITORY_TITLE' ) ) && ! empty( get_env( 'GITHUB_REPOSITORY_TITLE' ) ) ) {
	if ( ! is_env_not_exists( get_env( 'GITHUB_REPOSITORY_SLUG' ) ) ) {
		$slug        = get_env( 'GITHUB_REPOSITORY_SLUG' );
		$repo_titles = json_decode( file_get_contents( 'https://cdn.svarun.dev/json/repo-titles.json' ), true );
		_echo( '🎞️ Checking - Repository Title Database' );
		$title = '';
		if ( isset( $repo_titles[ $slug ] ) ) {
			$title = $repo_titles[ $slug ];
			_echo( "✔️ Repository Title Found In Database -  ${title}" );
		}

		set_action_env_not_exists( 'GITHUB_REPOSITORY_TITLE', $title );
		_echo( '::error:: 🛑 Repository SLUG Not Found !' );
	} else {
		_echo( '::error:: 🛑 Repository SLUG Not Found !' );
	}
} else {
	$title = get_env( 'GITHUB_REPOSITORY_TITLE' );
	_echo( "✔️ Repository Title Already Set - ${title}" );
}

_echo( '###[endgroup]' );