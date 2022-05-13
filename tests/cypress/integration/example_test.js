describe('Confirm Cypress works', () => {
    it('works', () =>  {
        cy.visit('/').contains('Laravel');

    })
});
