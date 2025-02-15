package example

import (
    client "github.com/basic-auth/fern/client"
    option "github.com/basic-auth/fern/option"
    context "context"
)

func do() () {
    client := client.NewClient(
        option.WithBasicAuth(
            "<username>",
            "<password>",
        ),
    )
    client.BasicAuth.PostWithBasicAuth(
        context.TODO(),
        map[string]interface{}{
            "key": "value",
        },
    )
}
