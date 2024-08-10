<?php

namespace Tests\Feature;

use App\Models\MovieReview;
use App\Models\SerieRating;
use App\Models\SerieReview;
use App\Models\User;
use App\Models\Serie;
use App\Models\Movie;
use App\Models\MovieRating;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class ProfileReviewsAndRatingsTest extends TestCase
{
    public function test_are_rated_or_reviewed_movies_showed(): void
    {
        $user = User::factory()->create();
        $movie = Movie::factory()->create();

        $this->actingAs($user);

        $review = MovieReview::create([
            'user_id' => $user->id,
            'movie_id' => $movie->id,
            'content' => 'This is a great movie, Boris as actor was unbeliavable!',
        ]);

        $rating = MovieRating::create([
            'user_id' => $user->id,
            'movie_id' => $movie->id,
            'rating' => 10,
        ]);

        $userId = Auth::id();
        $response = $this->get(route('profile.movie-reviews-ratings', ['id' => $userId]));

        $response->assertStatus(200);
        $response->assertSee($review->content);
        $response->assertSee($movie->title);
        $response->assertSee($rating->rating);

    }

    public function test_are_rated_or_reviewed_series_showed(): void
    {
        $user = User::factory()->create();
        $serie = Serie::factory()->create();

        $this->actingAs($user);

        $review = SerieReview::create([
            'user_id' => $user->id,
            'serie_id' => $serie->id,
            'content' => 'This is a great movie, Boris as actor was unbeliavable!',
        ]);

        $rating = SerieRating::create([
            'user_id' => $user->id,
            'serie_id' => $serie->id,
            'rating' => 10,
        ]);

        $userId = Auth::id();
        $response = $this->get(route('profile.serie-reviews-ratings', ['id' => $userId]));

        $response->assertStatus(200);
        $response->assertSee($review->content);
        $response->assertSee($serie->title);
        $response->assertSee($rating->rating);

    }

    public function test_can_rated_movies_be_deleted()
    {
        $user = User::factory()->create();
        $movie = Movie::factory()->create();

        $this->actingAs($user);

        $rating = MovieRating::create([
            'user_id' => $user->id,
            'movie_id' => $movie->id,
            'rating' => 10,
        ]);

        $response = $this->delete(route('movie-ratings.destroy', $rating->id));

        $response->assertStatus(302);
        $response->assertSessionHas('success', 'Rating deleted successfully.');
        $this->assertDatabaseMissing('movie_ratings', [
            'id' => $rating->id,
        ]);
    }

    public function test_can_reviewed_movies_be_deleted()
    {
        $user = User::factory()->create();
        $movie = Movie::factory()->create();

        $this->actingAs($user);

        $review = MovieReview::create([
            'user_id' => $user->id,
            'movie_id' => $movie->id,
            'content' => "testtesttest",
        ]);

        $response = $this->delete(route('movie-reviews.destroy', $review->id));

        $response->assertStatus(302);
        $response->assertSessionHas('success', 'Review deleted successfully.');
        $this->assertDatabaseMissing('movie_reviews', [
            'id' => $review->id,
        ]);
    }

    public function test_can_rated_series_be_deleted()
    {
        $user = User::factory()->create();
        $serie = Serie::factory()->create();

        $this->actingAs($user);

        $rating = SerieRating::create([
            'user_id' => $user->id,
            'serie_id' => $serie->id,
            'rating' => 5,
        ]);

        $response = $this->delete(route('serie-ratings.destroy', $rating->id));

        $response->assertStatus(302);
        $response->assertSessionHas('success', 'Rating deleted successfully.');
        $this->assertDatabaseMissing('serie_ratings', [
            'id' => $rating->id,
        ]);
    }

    public function test_can_reviewed_series_be_deleted()
    {
        $user = User::factory()->create();
        $serie = Serie::factory()->create();

        $this->actingAs($user);

        $review = SerieReview::create([
            'user_id' => $user->id,
            'serie_id' => $serie->id,
            'content' => "masulathegoat",
        ]);

        $response = $this->delete(route('serie-reviews.destroy', $review->id));

        $response->assertStatus(302);
        $response->assertSessionHas('success', 'Review deleted successfully.');
        $this->assertDatabaseMissing('serie_reviews', [
            'id' => $review->id,
        ]);
    }
}
