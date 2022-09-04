describe.only("Login Test", () => {
    it('can login with correct details', () => {
        cy.visit({route: 'login'});

        cy.create({
            model: 'App\\Models\\User',
            attributes: {email: 'admin@parrot.test'},
            state: 'withPersonalTeam',
            count: 1,
        });

        cy.get('[data-cy=email]').type('admin@parrot.test')
        cy.get('[data-cy=password]').type('password')
        cy.get('[data-cy=login]').click()

        cy.assertRedirect(Cypress.Laravel.route('dashboard'))
    })

    it("Login fails with wrong credentials", ()=> {
        cy.visit({route: 'login'});

        cy.get('[data-cy=email]').type('no-user@parrot.test')
        cy.get('[data-cy=password]').type('password')
        cy.get('[data-cy=login]').click()
    })
})
