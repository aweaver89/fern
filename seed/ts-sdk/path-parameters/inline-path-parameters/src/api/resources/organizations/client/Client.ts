/**
 * This file was auto-generated by Fern from our API Definition.
 */

import * as core from "../../../../core";
import * as SeedPathParameters from "../../../index";
import urlJoin from "url-join";
import * as serializers from "../../../../serialization/index";
import * as errors from "../../../../errors/index";

export declare namespace Organizations {
    interface Options {
        environment: core.Supplier<string>;
        tenantId: string;
    }

    interface RequestOptions {
        /** The maximum time to wait for a response in seconds. */
        timeoutInSeconds?: number;
        /** The number of times to retry the request. Defaults to 2. */
        maxRetries?: number;
        /** A hook to abort the request. */
        abortSignal?: AbortSignal;
        /** Additional headers to include in the request. */
        headers?: Record<string, string>;
    }
}

export class Organizations {
    constructor(protected readonly _options: Organizations.Options) {}

    /**
     * @param {string} organizationId
     * @param {Organizations.RequestOptions} requestOptions - Request-specific configuration.
     *
     * @example
     *     await client.organizations.getOrganization("organizationId")
     */
    public async getOrganization(
        organizationId: string,
        requestOptions?: Organizations.RequestOptions
    ): Promise<SeedPathParameters.Organization> {
        const _response = await core.fetcher({
            url: urlJoin(
                await core.Supplier.get(this._options.environment),
                `/${encodeURIComponent(this._options.tenantId)}/organizations/${encodeURIComponent(organizationId)}/`
            ),
            method: "GET",
            headers: {
                "X-Fern-Language": "JavaScript",
                "X-Fern-SDK-Name": "@fern/path-parameters",
                "X-Fern-SDK-Version": "0.0.1",
                "User-Agent": "@fern/path-parameters/0.0.1",
                "X-Fern-Runtime": core.RUNTIME.type,
                "X-Fern-Runtime-Version": core.RUNTIME.version,
                ...requestOptions?.headers,
            },
            contentType: "application/json",
            requestType: "json",
            timeoutMs: requestOptions?.timeoutInSeconds != null ? requestOptions.timeoutInSeconds * 1000 : 60000,
            maxRetries: requestOptions?.maxRetries,
            abortSignal: requestOptions?.abortSignal,
        });
        if (_response.ok) {
            return serializers.Organization.parseOrThrow(_response.body, {
                unrecognizedObjectKeys: "passthrough",
                allowUnrecognizedUnionMembers: true,
                allowUnrecognizedEnumValues: true,
                breadcrumbsPrefix: ["response"],
            });
        }

        if (_response.error.reason === "status-code") {
            throw new errors.SeedPathParametersError({
                statusCode: _response.error.statusCode,
                body: _response.error.body,
            });
        }

        switch (_response.error.reason) {
            case "non-json":
                throw new errors.SeedPathParametersError({
                    statusCode: _response.error.statusCode,
                    body: _response.error.rawBody,
                });
            case "timeout":
                throw new errors.SeedPathParametersTimeoutError(
                    "Timeout exceeded when calling GET /{tenantId}/organizations/{organizationId}/."
                );
            case "unknown":
                throw new errors.SeedPathParametersError({
                    message: _response.error.errorMessage,
                });
        }
    }

    /**
     * @param {SeedPathParameters.GetOrganizationUserRequest} request
     * @param {Organizations.RequestOptions} requestOptions - Request-specific configuration.
     *
     * @example
     *     await client.organizations.getOrganizationUser({
     *         organizationId: "organizationId",
     *         userId: "userId"
     *     })
     */
    public async getOrganizationUser(
        request: SeedPathParameters.GetOrganizationUserRequest,
        requestOptions?: Organizations.RequestOptions
    ): Promise<SeedPathParameters.User> {
        const _response = await core.fetcher({
            url: urlJoin(
                await core.Supplier.get(this._options.environment),
                `/${encodeURIComponent(this._options.tenantId)}/organizations/${encodeURIComponent(
                    request.organizationId
                )}/users/${encodeURIComponent(request.userId)}`
            ),
            method: "GET",
            headers: {
                "X-Fern-Language": "JavaScript",
                "X-Fern-SDK-Name": "@fern/path-parameters",
                "X-Fern-SDK-Version": "0.0.1",
                "User-Agent": "@fern/path-parameters/0.0.1",
                "X-Fern-Runtime": core.RUNTIME.type,
                "X-Fern-Runtime-Version": core.RUNTIME.version,
                ...requestOptions?.headers,
            },
            contentType: "application/json",
            requestType: "json",
            timeoutMs: requestOptions?.timeoutInSeconds != null ? requestOptions.timeoutInSeconds * 1000 : 60000,
            maxRetries: requestOptions?.maxRetries,
            abortSignal: requestOptions?.abortSignal,
        });
        if (_response.ok) {
            return serializers.User.parseOrThrow(_response.body, {
                unrecognizedObjectKeys: "passthrough",
                allowUnrecognizedUnionMembers: true,
                allowUnrecognizedEnumValues: true,
                breadcrumbsPrefix: ["response"],
            });
        }

        if (_response.error.reason === "status-code") {
            throw new errors.SeedPathParametersError({
                statusCode: _response.error.statusCode,
                body: _response.error.body,
            });
        }

        switch (_response.error.reason) {
            case "non-json":
                throw new errors.SeedPathParametersError({
                    statusCode: _response.error.statusCode,
                    body: _response.error.rawBody,
                });
            case "timeout":
                throw new errors.SeedPathParametersTimeoutError(
                    "Timeout exceeded when calling GET /{tenantId}/organizations/{organizationId}/users/{userId}."
                );
            case "unknown":
                throw new errors.SeedPathParametersError({
                    message: _response.error.errorMessage,
                });
        }
    }

    /**
     * @param {string} organizationId
     * @param {SeedPathParameters.SearchOrganizationsRequest} request
     * @param {Organizations.RequestOptions} requestOptions - Request-specific configuration.
     *
     * @example
     *     await client.organizations.searchOrganizations("organizationId", {
     *         limit: 1
     *     })
     */
    public async searchOrganizations(
        organizationId: string,
        request: SeedPathParameters.SearchOrganizationsRequest = {},
        requestOptions?: Organizations.RequestOptions
    ): Promise<SeedPathParameters.Organization[]> {
        const { limit } = request;
        const _queryParams: Record<string, string | string[] | object | object[]> = {};
        if (limit != null) {
            _queryParams["limit"] = limit.toString();
        }

        const _response = await core.fetcher({
            url: urlJoin(
                await core.Supplier.get(this._options.environment),
                `/${encodeURIComponent(this._options.tenantId)}/organizations/${encodeURIComponent(
                    organizationId
                )}/search`
            ),
            method: "GET",
            headers: {
                "X-Fern-Language": "JavaScript",
                "X-Fern-SDK-Name": "@fern/path-parameters",
                "X-Fern-SDK-Version": "0.0.1",
                "User-Agent": "@fern/path-parameters/0.0.1",
                "X-Fern-Runtime": core.RUNTIME.type,
                "X-Fern-Runtime-Version": core.RUNTIME.version,
                ...requestOptions?.headers,
            },
            contentType: "application/json",
            queryParameters: _queryParams,
            requestType: "json",
            timeoutMs: requestOptions?.timeoutInSeconds != null ? requestOptions.timeoutInSeconds * 1000 : 60000,
            maxRetries: requestOptions?.maxRetries,
            abortSignal: requestOptions?.abortSignal,
        });
        if (_response.ok) {
            return serializers.organizations.searchOrganizations.Response.parseOrThrow(_response.body, {
                unrecognizedObjectKeys: "passthrough",
                allowUnrecognizedUnionMembers: true,
                allowUnrecognizedEnumValues: true,
                breadcrumbsPrefix: ["response"],
            });
        }

        if (_response.error.reason === "status-code") {
            throw new errors.SeedPathParametersError({
                statusCode: _response.error.statusCode,
                body: _response.error.body,
            });
        }

        switch (_response.error.reason) {
            case "non-json":
                throw new errors.SeedPathParametersError({
                    statusCode: _response.error.statusCode,
                    body: _response.error.rawBody,
                });
            case "timeout":
                throw new errors.SeedPathParametersTimeoutError(
                    "Timeout exceeded when calling GET /{tenantId}/organizations/{organizationId}/search."
                );
            case "unknown":
                throw new errors.SeedPathParametersError({
                    message: _response.error.errorMessage,
                });
        }
    }
}
