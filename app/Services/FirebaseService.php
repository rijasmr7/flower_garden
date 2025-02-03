<?php

namespace App\Services;

use Kreait\Firebase\Factory;

class FirebaseService
{
    protected $firebase;

    public function __construct()
    {
        // Load Firebase credentials from .env
        $firebaseCredentials = env('FIREBASE_CREDENTIALS');

        // Ensure the credentials file exists
        if (!file_exists($firebaseCredentials)) {
            throw new \Exception("Firebase credentials file not found at {$firebaseCredentials}");
        }

        // Initialize Firebase with the credentials
        $this->firebase = (new Factory)
            ->withServiceAccount($firebaseCredentials) // Use the correct service account JSON file
            ->withDatabaseUri('https://flowergarden-cf0cb-default-rtdb.firebaseio.com/') // Set the correct Firebase Realtime Database URL
            ->createDatabase(); // Initialize the Firebase database instance
    }

    // Add a wishlist entry to Firebase
    public function storeWishlistToFirebase($data)
    {
        $database = $this->firebase;
        $reference = $database->getReference('wishlists');
        $newWishlist = $reference->push($data); // Save wishlist in Firebase

        return [
            'id' => $newWishlist->getKey(),
            'data' => $data
        ];
    }

    // Retrieve all wishlists from Firebase
    public function getWishlistsFromFirebase()
    {
        $database = $this->firebase;
        return $database->getReference('wishlists')->getValue(); // Returns an array of wishlists
    }

    // Delete a wishlist entry from Firebase
    public function deleteWishlistFromFirebase($id)
    {
        $database = $this->firebase;
        $reference = $database->getReference('wishlists/' . $id);
        $reference->remove(); // Delete wishlist from Firebase
        return true;
    }
}
