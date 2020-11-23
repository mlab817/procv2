<?php

namespace App\GraphQL\Mutations;

use NotificationChannels\Discord\Discord;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

class ConfigureUserDiscordSettings
{
    /**
     * @param null $_
     * @param array<string, mixed> $args
     * @param GraphQLContext $context
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function __invoke($_, array $args, GraphQLContext $context)
    {
        $user = $context->user();

        $userId = $args['discord_user_id'];
        $channelId = app(Discord::class)->getPrivateChannel($userId);

        $user->update([
            'discord_user_id' => $userId,
            'discord_private_channel_id' => $channelId
        ]);

        return $user;
    }
}
